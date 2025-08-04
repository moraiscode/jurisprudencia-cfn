<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jurisprudência - Chat de Suporte Jurídico</title>
    <meta name="description" content="Explore o chat de suporte jurídico da Jurisprudência. Obtenha respostas rápidas para suas dúvidas legais e acesse informações atualizadas.">
    <meta name="keywords" content="jurisprudência, suporte jurídico, chat legal, normas, documentos legais, consulta jurídica">
    <meta name="author" content="xAI">
    <meta name="robots" content="index, follow">
    <meta name="language" content="pt-BR">
    <meta property="og:title" content="Jurisprudência - Chat de Suporte Jurídico">
    <meta property="og:description" content="Obtenha suporte jurídico rápido e eficiente com o chat da Jurisprudência. Consulte normas e documentos legais de forma prática.">
    <meta property="og:image" content="otg.png">
    <meta property="og:url" content="https://easypanel.moraiscode.com/">
    <meta property="og:type" content="website">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="Jurisprudência - Chat de Suporte Jurídico">
    <meta name="twitter:description" content="Suporte jurídico via chat com respostas instantâneas. Acesse normas e documentos legais agora!">
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
    <!-- Google Fonts (Roboto, conforme Material Design) -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <img src="favicon/favicon-96x96.png" alt="">
            <a class="navbar-brand" href="/">Juris v1.1.5</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="https://n8n-n8n.bqznqa.easypanel.host/form/1cffb451-34fb-44a7-99a3-5bb5ec7817ac" target="_blank"><i class="fa-solid fa-cloud-arrow-up"></i> Upload de Lei</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="normas.php" target="_blank"><i class="fa-solid fa-list"></i> Lista de normas</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa-solid fa-unlock-keyhole"></i> Admin</a>
                    </li> -->
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container text-center search-container" id="searchContainer">
        <img src="logo.png" alt="Logo Jurisprudência" class="img-fluid logo">
        <form id="searchForm" onsubmit="handleSearch(event)">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" id="query" name="query" placeholder="Pergunte-me qualquer coisa sobre leis internas" autocomplete="off" required>
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
    <!-- Custom JS -->
    <script src="js/ia.js"></script>
</body>
</html>