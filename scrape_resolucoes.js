const puppeteer = require("puppeteer");
const mysql = require("mysql2/promise");

// Configurações do intervalo e banco de dados
const startId = 739; // Alterar aqui para reiniciar de onde parou
const endId = 742; // Alterar aqui para definir o limite final
const dbConfig = {
  host: "easypanel.moraiscode.com",
  port: 33061,
  database: "jurisprudencia",
  user: "jurisprudencia",
  password: "@5Wl17ru9",
};

// Função para conectar ao banco de dados
async function connectDb() {
  try {
    const conn = await mysql.createConnection(dbConfig);
    console.log("✅ Conexão com o banco de dados bem-sucedida!");
    return conn;
  } catch (err) {
    console.error(`❌ Erro ao conectar ao banco de dados: ${err.message}`);
    return null;
  }
}

// Função para extrair dados da página com retry
async function scrapeResolution(id) {
  const url = `http://sisnormas.cfn.org.br:8081/viewPage.html?id=${id
    .toString()
    .padStart(3, "0")}`;
  console.log(`🔄 Acessando: ${url}`);

  const browser = await puppeteer.launch({
    headless: true,
    args: ["--no-sandbox", "--disable-setuid-sandbox"],
  });
  let data = null;
  for (let attempt = 0; attempt < 3; attempt++) {
    try {
      const page = await browser.newPage();
      await page.setUserAgent(
        "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36"
      );

      // Acessar a página com tempo limite maior
      await page.goto(url, { waitUntil: "networkidle0", timeout: 180000 });

      // Esperar um pouco mais para garantir o carregamento de conteúdo dinâmico
      await new Promise((resolve) => setTimeout(resolve, 5000));

      data = await page.evaluate(
        (resId) => {
          // Função de limpeza dentro do contexto do navegador
          function cleanText(text) {
            return text
              .replace(/\s+/g, " ") // Reduz múltiplos espaços/tabs/quebras de linha
              .replace(/[\`\-\.\,]{2,}/g, "") // Remove sequências de ```, --, ..., ,, etc.
              .trim(); // Remove espaços no início e no fim
          }

          const allText = document.body?.innerText.trim() || "";

          // Extrair título (primeira linha ou texto inicial)
          const lines = allText
            .split("\n")
            .filter((line) => line.trim().length > 0); // Filtra linhas vazias
          let title = lines[0]?.trim() || `RESOLUÇÃO CFN Nº ${resId}`;

          // Verificar se é revogada
          const isRevoked =
            allText.includes("Revogada pela") ||
            allText.includes("Revogado por");
          let ano = null;
          let observacao = "";
          let conteudo = "";

          if (isRevoked) {
            observacao = "REVOGADA";
            conteudo = null; // Conteúdo vazio para resoluções revogadas
          } else {
            // Extrair ano do título
            let anoMatch = title.match(/\b(\d{4})\b/);
            ano = anoMatch ? parseInt(anoMatch[1]) : null;

            // Extrair conteúdo completo (remover o título)
            let content = allText.replace(title, "").trim();
            content = content.replace(/\n+/g, "\n").trim(); // Normalizar quebras de linha

            // Extrair observação (Art. 1º)
            let art1Match = content.match(
              /Art\.?\s*1º\.?\s*(.*?)(?=(Art\.?\s*\d+º|\Z))/is
            );
            observacao = art1Match
              ? cleanText(art1Match[1])
              : cleanText(content.slice(0, 200));

            // Extrair conteúdo (todo o texto após o título, limpo)
            conteudo = cleanText(content);
          }

          console.log(
            `DEBUG - Título: ${title}, Ano: ${ano}, Observação: ${observacao.substring(
              0,
              50
            )}..., Conteúdo: ${
              conteudo ? conteudo.substring(0, 50) : "NULL"
            }...`
          );

          return {
            tipo_id: 3,
            ano,
            observacao,
            conteudo,
            titulo: title,
            caminho_arquivo: null,
          };
        },
        id,
        { timeout: 30000 }
      ); // Timeout no evaluate para evitar congelamento

      await page.close();
      break; // Sai do loop se bem-sucedido
    } catch (err) {
      console.error(
        `❌ Tentativa ${attempt + 1} para resolução ${id} falhou: ${
          err.message
        }`
      );
      await new Promise((resolve) => setTimeout(resolve, 5000)); // Espera 5 segundos antes de retry
      if (attempt === 2) {
        console.error(`❌ Todas as tentativas para resolução ${id} falharam.`);
        data = null;
      }
    }
  }
  await browser.close();
  return data;
}

// Função para inserir dados no banco
async function insertResolution(conn, data) {
  try {
    await conn.query(
      "INSERT INTO documentos (tipo_id, ano, observacao, conteudo, caminho_arquivo, titulo) VALUES (?, ?, ?, ?, ?, ?)",
      [
        data.tipo_id,
        data.ano,
        data.observacao,
        data.conteudo,
        data.caminho_arquivo,
        data.titulo,
      ]
    );
    console.log(`✅ Resolução ${data.titulo} inserida com sucesso!`);
    return true;
  } catch (err) {
    console.error(
      `❌ Erro ao inserir resolução ${data.titulo}: ${err.message}`
    );
    return false;
  }
}

// Função principal
async function main() {
  const conn = await connectDb();
  if (!conn) {
    console.log("❌ Encerrando devido a falha na conexão com o banco.");
    return;
  }

  let lastProcessedId = startId - 1; // Para rastrear o último ID processado
  for (let i = startId; i <= endId; i++) {
    const data = await scrapeResolution(i);
    if (data) {
      const success = await insertResolution(conn, data);
      if (success) {
        lastProcessedId = i;
        await new Promise((resolve) => setTimeout(resolve, 1000)); // Rate limiting
      } else {
        console.log(
          `❌ Falha na inserção para resolução ${i}. Encerrando. Último ID processado: ${lastProcessedId}`
        );
        break;
      }
    } else {
      console.log(
        `❌ Falha ao processar resolução ${i}. Encerrando. Último ID processado: ${lastProcessedId}`
      );
      break;
    }
  }

  await conn.end();
  console.log(
    `🔌 Conexão com o banco de dados encerrada. Último ID processado: ${lastProcessedId}`
  );
}

// Executar o programa
main().catch((err) => console.error("❌ Erro no programa:", err.message));
