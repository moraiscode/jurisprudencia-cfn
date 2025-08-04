
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jurisprudência</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome para ícones -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts (Roboto, conforme Material Design) -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow-y: auto;
        }
        body::-webkit-scrollbar {
            width: 8px;
        }
        body::-webkit-scrollbar-track {
            background: #f1f3f4;
        }
        body::-webkit-scrollbar-thumb {
            background-color: #dfe5e8;
            border-radius: 4px;
        }
        .navbar {
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .search-container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
        }
        .search-box {
            position: relative;
            display: flex;
            align-items: center;
            background-color: #ffffff;
            border: 1px solid #dfe1e5;
            border-radius: 24px;
            padding: 10px 15px;
            box-shadow: 0 1px 6px rgba(32, 33, 36, 0.28);
            transition: box-shadow 0.2s ease, transform 0.2s ease;
        }
        .search-box:focus-within {
            box-shadow: 0 3px 12px rgba(32, 33, 36, 0.4);
            transform: scale(1.02);
        }
        .search-box input {
            border: none;
            outline: none;
            flex: 1;
            font-size: 16px;
        }
        .search-box i {
            color: #5f6368;
            font-size: 18px;
            margin-right: 10px;
        }
        .logo {
            max-width: 200px;
            margin-bottom: 20px;
        }
        .chat-container {
            max-width: 600px;
            margin: 20px auto;
            padding: 0 20px;
            display: flex;
            flex-direction: column-reverse;
        }
        .message {
            margin-bottom: 15px;
            max-width: 80%;
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }
        .user-message {
            background-color: #d4edda;
            border-radius: 12px;
            padding: 10px 15px;
            align-self: flex-end;
            text-align: right;
        }
        .bot-message {
            background-color: #e8ecef;
            border-radius: 12px;
            padding: 10px 15px;
            text-align: left;
        }
        .thinking {
            display: flex;
            gap: 4px;
            align-items: center;
        }
        .thinking-dot {
            width: 8px;
            height: 8px;
            background-color: #4a90e2;
            border-radius: 50%;
            animation: blink 1.4s infinite both;
        }
        .thinking-dot:nth-child(2) {
            animation-delay: 0.2s;
        }
        .thinking-dot:nth-child(3) {
            animation-delay: 0.4s;
        }
        @keyframes blink {
            0% { opacity: 0.2; }
            20% { opacity: 1; }
            100% { opacity: 0.2; }
        }
        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            font-size: 20px;
        }
        .user-avatar {
            background-color: #28a745;
        }
        .bot-avatar {
            background-color: #4a90e2;
        }
        footer {
            background-color: #f1f3f4;
            padding: 10px 0;
            text-align: center;
            color: #5f6368;
            font-size: 14px;
        }
        footer > p {
            margin: auto;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Jurisprudência</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/create_document.php">Criar Documento</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin.php">Administrativo</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container text-center search-container" id="searchContainer">
        <img src="images/logo.png" alt="Logo Jurisprudência" class="img-fluid logo">
        <form id="searchForm" onsubmit="handleSearch(event)">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" id="query" name="query" placeholder="Pergunte-me qualquer coisa" autocomplete="off" required>
            </div>
        </form>
        <div class="chat-container" id="chatContainer"></div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 Jurisprudência. Todos os direitos reservados.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        async function handleSearch(event) {
            event.preventDefault();
            const query = document.getElementById('query').value.trim();
            if (!query) return;

            const webhook = 'https://n8n-n8n.bqznqa.easypanel.host/webhook/55468fea-aa14-4b74-8e47-8fcccb9cffc1';
            const chatContainer = document.getElementById('chatContainer');
            const searchContainer = document.getElementById('searchContainer');

            // Adiciona a mensagem do usuário com avatar
            const userMessage = document.createElement('div');
            userMessage.className = 'message';
            userMessage.innerHTML = `<div class="avatar user-avatar"><i class="fa-solid fa-user"></i></div><div class="user-message">${query}</div>`;
            chatContainer.prepend(userMessage); // Adiciona no início

            // Adiciona a animação de "pensando" com avatar
            const thinkingMessage = document.createElement('div');
            thinkingMessage.className = 'message';
            thinkingMessage.innerHTML = `<div class="avatar bot-avatar"><i class="fa-solid fa-robot"></i></div><div class="bot-message"><div class="thinking"><div class="thinking-dot"></div><div class="thinking-dot"></div><div class="thinking-dot"></div></div></div>`;
            chatContainer.prepend(thinkingMessage); // Adiciona no início

            // Rolagem para a última mensagem (primeira visualmente)
            chatContainer.scrollTop = 0;

            try {
                const response = await fetch(`${webhook}?query=${encodeURIComponent(query)}`, {
                    method: 'GET',
                    headers: { 'Content-Type': 'application/json' }
                });

                const status = response.status;
                const rawResponse = await response.text();
                let data = rawResponse ? JSON.parse(rawResponse) : {};

                // Remove a animação de "pensando" e adiciona a resposta
                chatContainer.removeChild(thinkingMessage);
                let result = 'Não houve retorno da I.A! Possíveis causas: <ul><li>Webhook não configurado corretamente</li><li>IA não respondeu</li><li>Erro na conexão com o servidor</li></ul>';
                if (Array.isArray(data) && data.length > 0 && data[0].output) {
                    result = data[0].output.replace(/\n/g, '<br>');
                } else if (rawResponse) {
                    result += `<br><small>Método: GET, Status: ${status}, Resposta Bruta: ${rawResponse}</small>`;
                }
                const botMessage = document.createElement('div');
                botMessage.className = 'message';
                botMessage.innerHTML = `<div class="avatar bot-avatar"><i class="fa-solid fa-robot"></i></div><div class="bot-message">${result}</div>`;
                chatContainer.prepend(botMessage); // Adiciona no início

                // Rolagem para a última mensagem (primeira visualmente)
                chatContainer.scrollTop = 0;
            } catch (error) {
                chatContainer.removeChild(thinkingMessage);
                const botMessage = document.createElement('div');
                botMessage.className = 'message';
                botMessage.innerHTML = `<div class="avatar bot-avatar"><i class="fa-solid fa-robot"></i></div><div class="bot-message">Não houve retorno da I.A! Possíveis causas: <ul><li>Erro na conexão: ${error.message}</li><li>Webhook indisponível</li><li>Formato de resposta inválido</li></ul><br><small>Método: GET, Status: ${error.response?.status || 'N/A'}, Resposta Bruta: ${error.message}</small></div>`;
                chatContainer.prepend(botMessage); // Adiciona no início
                chatContainer.scrollTop = 0;
            }

            // Limpa o campo de entrada
            document.getElementById('query').value = '';
            searchContainer.classList.add('scrolled');
        }
    </script>
</body>
</html>
