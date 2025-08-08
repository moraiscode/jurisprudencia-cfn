<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>I.A Resoluções - Editor de Parecer do CFN</title>
    <meta name="description"
        content="Crie e edite pareceres jurídicos com o editor inteligente do Conselho Federal de Nutricionistas (CFN). Gere documentos personalizados com base em resoluções.">
    <meta name="keywords"
        content="parecer CFN, editor jurídico, resoluções CFN, documentos legais, consulta normativa, download parecer">
    <meta name="author" content="xAI">
    <meta name="robots" content="index, follow">
    <meta name="language" content="pt-BR">
    <meta property="og:title" content="I.A Resoluções - Editor de Parecer do CFN">
    <meta property="og:description"
        content="Editor inteligente para criar pareceres jurídicos do CFN. Personalize e baixe documentos em formato .docx.">
    <meta property="og:image" content="otg.png">
    <meta property="og:url" content="https://app-jurisprudencia.bqznqa.easypanel.host/parecer.php">
    <meta property="og:type" content="website">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="I.A Resoluções - Editor de Parecer do CFN">
    <meta name="twitter:description"
        content="Crie pareceres jurídicos com o editor do CFN e baixe em .docx. Suporte às resoluções do CFN.">
    <meta name="twitter:image" content="otg.png">
    <link rel="icon" type="image/png" href="favicon/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="favicon/favicon.svg" />
    <link rel="shortcut icon" href="favicon/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png" />
    <meta name="apple-mobile-web-app-title" content="Juris" />
    <link rel="manifest" href="favicon/site.webmanifest" />
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome para ícones -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts (Roboto) -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- Quill CSS -->
    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
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
        max-width: 800px;
        margin: auto;
        padding: 20px;
        margin-bottom: 10%;
    }

    .search-box {
        position: relative;
        display: flex;
        align-items: center;
        background-color: #ffffff;
        border: 1px solid #dfe1e5;
        border-radius: 10px;
        padding: 10px 15px;
        box-shadow: 0 1px 6px rgb(32 33 36 / 8%);
        transition: box-shadow 0.2s ease, transform 0.2s ease;
    }

    .search-box:focus-within {
        box-shadow: 0 3px 12px rgb(32 33 36 / 20%);
        transform: scale(1.02);
    }

    .search-box textarea {
        border: none;
        outline: none;
        flex: 1;
        font-size: 16px;
        resize: vertical;
        min-height: 150px;
        padding: 10px;
        width: 100%;
    }

    .logo {
        max-width: 90%;
        margin-bottom: 40px;
    }

    .chat-container {
        max-width: 800px;
        margin: 7% auto;
        display: none;
        /* Oculta por padrão, só aparece no modo normal */
    }

    .message {
        margin-bottom: 15px;
        display: flex;
        align-items: flex-start;
        gap: 10px;
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
        0% {
            opacity: 0.2;
        }

        20% {
            opacity: 1;
        }

        100% {
            opacity: 0.2;
        }
    }

    footer {
        background-color: #f1f3f4;
        padding: 10px 0;
        text-align: center;
        color: #5f6368;
        font-size: 14px;
        position: relative;
        z-index: 1;
    }

    footer>p {
        margin: auto;
    }

    .navbar-brand>img {
        max-width: 40px;
        margin-right: 10px;
    }

    a.navbar-brand {
        font-size: 2vh;
    }

    @media (max-width: 768px) {
        .message {
            max-width: fit-content;
        }

        div#chatContainer {
            padding: initial;
        }
    }

    #editor-container {
        margin: 20px 0;
        border-radius: 10px;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    #editor-container.expanded {
        width: 90%;
        max-width: 1200px;
        margin: 20px auto;
        font-size: 18px;
        /* Aumenta a fonte */
    }

    #editor-container.expanded .ql-editor {
        font-size: 18px;
        /* Aumenta a fonte no editor */
    }

    .ql-toolbar {
        position: sticky;
        top: 0;
        z-index: 1000;
        background: #fff;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        border: 1px solid #d6dbe6;
        border-bottom: 0;
    }

    #quillEditor {
        border: 1px solid #d6dbe6;
        border-top: 0;
        border-radius: 0 0 10px 10px;
        min-height: 320px;
        max-height: 70vh;
        overflow-y: auto;
        padding: 12px;
        background: #fff;
        max-height: fit-content;
    }

    .button-group {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin: 10px 0;
    }

    .btn-custom {
        display: inline-flex;
        align-items: center;
        font-family: 'Roboto', sans-serif;
        font-size: 14px;
        font-weight: 500;
        color: #425d71;
        background-color: #f8f9fa;
        border: 1px solid #dadce0;
        border-radius: 4px;
        padding: 8px 16px;
        transition: background-color 0.2s, box-shadow 0.2s;
    }

    .btn-custom:hover {
        background-color: #f1f3f4;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
    }

    .btn-custom i {
        margin-right: 8px;
    }

    .hidden {
        display: none !important;
    }

    .editor-actions {
        margin-top: 10px;
        display: flex;
        gap: 8px;
        justify-content: flex-end;
    }

    .fullscreen-active {
        position: fixed !important;
        top: 8px !important;
        left: 8px !important;
        right: 8px !important;
        bottom: 8px !important;
        z-index: 99999 !important;
        background: #fff;
        padding: 12px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.35);
        border-radius: 8px;
    }

    .ql-editor>p {
        font-size: 1rem;
    }

    .spinner-border.text-primary {
        color: #00be0a !important;
    }
    </style>
</head>

<body>
    <!-- <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="/"><img src="logo21.png" alt="Logo CFN">I.A Resoluções v1.1.5</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#" id="downloadDocx"><i class="fa-solid fa-download"></i> Download de
                            Documento</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav> -->

    <div class="container text-center search-container" id="searchContainer">
        <img src="logo2.png" alt="Logo Jurisprudência" class="img-fluid logo">
        <form id="searchForm">
            <div class="search-box">
                <textarea id="query" name="query" placeholder="Digite sua demanda de parecer sobre Resoluções do CFN"
                    autocomplete="off" required></textarea>
            </div>
            <div class="button-group">
                <button type="button" class="btn btn-custom" id="searchButton"><i class="fa-solid fa-search"></i>
                    Pesquisar</button>
                <a type="button" class="btn btn-custom" href="https://www.markdowntopdf.com/" target="_blank"><i
                        class="fa-solid fa-download"></i>
                    Converter para PDF
                </a> <!-- id="downloadDocxButton" -->

            </div>
        </form>
        <div id="loadingContainer" class="text-center mt-3 hidden">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Carregando...</span>
            </div>
            <div id="loadingText" class="mt-2">Carregando parecer... <span id="loadingSeconds">0</span>s</div>
        </div>

        <div class="chat-container" id="chatContainer">
            <div id="editorWrapper">
                <div id="toolbar">
                    <span class="ql-formats">
                        <select class="ql-header">
                            <option selected></option>
                            <option value="1"></option>
                            <option value="2"></option>
                            <option value="3"></option>
                        </select>
                        <select class="ql-font"></select>
                        <select class="ql-size"></select>
                    </span>
                    <span class="ql-formats">
                        <button class="ql-bold"></button>
                        <button class="ql-italic"></button>
                        <button class="ql-underline"></button>
                        <button class="ql-strike"></button>
                    </span>
                    <span class="ql-formats">
                        <button class="ql-list" value="ordered"></button>
                        <button class="ql-list" value="bullet"></button>
                        <button class="ql-indent" value="-1"></button>
                        <button class="ql-indent" value="+1"></button>
                    </span>
                    <span class="ql-formats">
                        <button class="ql-script" value="sub"></button>
                        <button class="ql-script" value="super"></button>
                        <button class="ql-blockquote"></button>
                        <button class="ql-code-block"></button>
                    </span>
                    <span class="ql-formats">
                        <select class="ql-color"></select>
                        <select class="ql-background"></select>
                    </span>
                    <span class="ql-formats">
                        <select class="ql-align"></select>
                        <button class="ql-direction" value="rtl"></button>
                    </span>
                    <span class="ql-formats">
                        <button class="ql-link"></button>
                        <button class="ql-image"></button>
                        <button class="ql-video"></button>
                    </span>
                    <span class="ql-formats">
                        <button class="ql-clean"></button>
                        <button id="ql-fullscreen-button" class="ql-fullscreen" title="Alternar tela cheia"
                            type="button">
                            <i class="fa fa-expand" aria-hidden="true"></i>
                        </button>
                    </span>
                </div>
                <div id="quillEditor"></div>
                <!-- <div class="editor-actions">
                    <button id="btnBackToSearch" class="btn btn-custom">Nova pesquisa</button>
                    <div style="flex:1"></div>
                    <small style="color:#666;align-self:center">Editor Quill com toolbar completa</small>
                </div> -->
            </div>
        </div>
    </div>

    <!-- <footer>
        <p><small>Conselho Federal de Nutrição &copy; 2025 - I.A de Resoluções.</small></p>
    </footer> -->

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Quill JS -->
    <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
    <!-- html-docx-js para converter HTML -> .docx -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html-docx-js/0.4.1/html-docx.js"></script>
    <!-- FileSaver JS para download -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
    <script>
    let loadingInterval;

    function showLoading() {
        let seconds = 0;
        document.getElementById('loadingSeconds').textContent = seconds;
        document.getElementById('loadingContainer').classList.remove('hidden');
        loadingInterval = setInterval(() => {
            seconds++;
            document.getElementById('loadingSeconds').textContent = seconds;
        }, 1000);
    }

    function hideLoading() {
        clearInterval(loadingInterval);
        document.getElementById('loadingContainer').classList.add('hidden');
    }

    // Inicializa o Quill
    const quill = new Quill('#quillEditor', {
        modules: {
            toolbar: {
                container: '#toolbar'
            }
        },
        placeholder: 'O resultado aparecerá aqui...',
        theme: 'snow'
    });

    // Fullscreen toggle
    const qlFullBtn = document.getElementById('ql-fullscreen-button');
    let isFullscreen = false;
    qlFullBtn.addEventListener('click', () => {
        toggleFullscreen();
    });

    function toggleFullscreen() {
        const wrapper = document.querySelector('#editorWrapper');
        if (!isFullscreen) {
            if (wrapper.requestFullscreen) {
                wrapper.requestFullscreen();
            } else if (wrapper.webkitRequestFullscreen) {
                wrapper.webkitRequestFullscreen();
            } else if (wrapper.msRequestFullscreen) {
                wrapper.msRequestFullscreen();
            }
        } else {
            if (document.exitFullscreen) {
                document.exitFullscreen();
            } else if (document.webkitExitFullscreen) {
                document.webkitExitFullscreen();
            } else if (document.msExitFullscreen) {
                document.msExitFullscreen();
            }
        }
        isFullscreen = !isFullscreen;
    }

    document.addEventListener('fullscreenchange', () => {
        isFullscreen = !!document.fullscreenElement;
    });

    async function handleSearch() {
        const query = document.getElementById('query').value.trim();
        if (!query) return;

        // Inicia loading
        showLoading();

        // Limpa o campo de entrada imediatamente
        document.getElementById('query').value = '';

        const chatContainer = document.getElementById('chatContainer');
        chatContainer.style.display = 'flex'; // Mostra o container

        // Adiciona apenas a animação de loading com contador
        const thinkingMessage = document.createElement('div');
        thinkingMessage.className = 'message';
        thinkingMessage.innerHTML =
            ``;
        chatContainer.prepend(thinkingMessage);

        // Rolagem para o topo
        chatContainer.scrollTop = 0;

        try {
            const webhook = 'https://n8n-n8n.bqznqa.easypanel.host/webhook/0902218f-22d6-4c2e-aeff-914648f8a24f';
            const response = await fetch(`${webhook}?query=${encodeURIComponent(query)}`, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json'
                }
            });

            const status = response.status;
            const rawResponse = await response.text();
            let data = rawResponse ? JSON.parse(rawResponse) : {};

            hideLoading();
            // Remove a animação de loading
            chatContainer.removeChild(thinkingMessage);

            let result = '';
            if (typeof data === 'object' && data.output) {
                result = data.output.replace(/\n/g, '\n'); // Preserva quebras de linha
            } else if (Array.isArray(data) && data.length > 0 && data[0].output) {
                result = data[0].output.replace(/\n/g, '\n');
            } else {
                result = 'Não consegui processar sua solicitação.';
            }

            // Converte o texto para formato compatível com Quill
            quill.root.innerHTML = result;
        } catch (error) {
            chatContainer.removeChild(thinkingMessage);
            const botMessage = document.createElement('div');
            botMessage.className = 'message';
            botMessage.innerHTML = `<div class="bot-message">Erro ao conectar ao servidor.</div>`;
            chatContainer.prepend(botMessage);
            chatContainer.scrollTop = 0;
        }
    }

    // Adiciona ouvinte para o botão Pesquisar
    document.getElementById('searchButton').addEventListener('click', handleSearch);

    // Adiciona ouvinte para tecla Enter
    document.getElementById('query').addEventListener('keypress', function(event) {
        if (event.key === 'Enter') {
            handleSearch();
        }
    });

    // Função para download em .docx com formatação legível
    document.getElementById('downloadDocxButton').addEventListener('click', function() {
        const contentHtml = quill.root.innerHTML;
        const preHtml =
            '<!DOCTYPE html><html><head><meta charset="utf-8"><title>Parecer</title><style>body { font-family: Arial, sans-serif; } h1, h2, h3 { margin: 10px 0; } p { margin: 10px 0; } ul, ol { margin: 10px 0 10px 20px; } strong { font-weight: bold; } em { font-style: italic; } a { color: #0066cc; text-decoration: underline; } img { max-width: 100%; }</style></head><body>';
        const postHtml = '</body></html>';
        const fullHtml = preHtml + contentHtml + postHtml;

        try {
            const converted = window.htmlDocx.asBlob(fullHtml, {
                orientation: 'portrait'
            });
            saveAs(converted, 'parecer.docx');
        } catch (err) {
            console.error('Erro ao converter para docx:', err);
            alert('Falha ao gerar .docx. Veja o console para detalhes.');
        }
    });

    // Função para aumentar/diminuir tela
    let isExpanded = false;
    const resizeButton = document.getElementById('resizeButton');
    const editorContainer = document.getElementById('editorWrapper');
    const searchContainer = document.getElementById('searchContainer');
    const chatContainer = document.getElementById('chatContainer');

    resizeButton.addEventListener('click', function() {
        if (!isExpanded) {
            // Aumenta o editor
            editorContainer.classList.add('expanded');
            resizeButton.innerHTML = '<i class="fa-solid fa-compress"></i> Diminuir Tela';
            searchContainer.classList.add('hidden'); // Oculta o restante
            chatContainer.style.display = 'flex'; // Garante que o container fique visível
            document.body.style.overflow = 'hidden'; // Impede rolagem
            isExpanded = true;
        } else {
            // Diminui o editor
            editorContainer.classList.remove('expanded');
            resizeButton.innerHTML = '<i class="fa-solid fa-expand"></i> Aumentar Tela';
            searchContainer.classList.remove('hidden'); // Mostra o restante
            document.body.style.overflow = 'auto'; // Restaura rolagem
            isExpanded = false;
        }
    });
    </script>
</body>

</html>