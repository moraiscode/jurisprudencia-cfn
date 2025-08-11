<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>I.A Resoluções - Chat de Suporte do CFN</title>
    <meta name="description"
        content="Acesse o chat inteligente de suporte às Resoluções do Conselho Federal de Nutricionistas (CFN). Encontre respostas rápidas e confiáveis sobre normas e regulamentações.">
    <meta name="keywords"
        content="resoluções CFN, suporte jurídico, chat CFN, normas nutricionistas, documentos CFN, consulta regulamentar">
    <meta name="author" content="xAI">
    <meta name="robots" content="index, follow">
    <meta name="language" content="pt-BR">

    <meta property="og:title" content="I.A Resoluções - Chat de Suporte do CFN">
    <meta property="og:description"
        content="Chat inteligente para consulta de Resoluções do CFN. Obtenha informações normativas de forma rápida e prática.">
    <meta property="og:image" content="otg.png">
    <meta property="og:url" content="https://app-jurisprudencia.bqznqa.easypanel.host">
    <meta property="og:type" content="website">

    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="I.A Resoluções - Chat de Suporte do CFN">
    <meta name="twitter:description"
        content="Chat com inteligência artificial para suporte às Resoluções do CFN. Consulte normas com agilidade.">
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
    <!-- <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <img src="logoia-minimal.png" alt="">
            <small class="text-muted">v1.2.1</small>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link"
                            href="https://n8n-n8n.bqznqa.easypanel.host/form/1cffb451-34fb-44a7-99a3-5bb5ec7817ac"
                            target="_blank"><i class="fa-solid fa-cloud-arrow-up"></i> Cadastro Manual</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="normas.php" target="_blank"><i class="fa-solid fa-list"></i> Lista de
                            Resoluções</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav> -->

    <!-- Main Content -->
    <div class="container text-center search-container" id="searchContainer">
        <img src="logo21.png" alt="Logo Jurisprudência" class="img-fluid logo">
        <form id="searchForm" onsubmit="handleSearch(event)">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" id="query" name="query"
                    placeholder="Pergunte-me qualquer coisa sobre Resoluções do CFN" autocomplete="off" required>
            </div>
            <div class="button-group mt-3">
                <a href="parecer.php" target="_blank" type="button" class="btn btn-custom me-2">
                    <i class="fa-regular fa-pen-to-square"></i> 
                    Parecer
                </a>
                <a href="https://n8n-n8n.bqznqa.easypanel.host/form/1cffb451-34fb-44a7-99a3-5bb5ec7817ac" target="_blank" type="button" class="btn btn-custom me-2">
                    <i class="fa-regular fa-circle-up"></i> 
                    Upload
                </a>
                <a href="normas.php" target="_blank" type="button" class="btn btn-custom me-2">
                    <i class="fa-regular fa-rectangle-list"></i> 
                    Resoluções
                </a>
                <!-- <a href="parecer.php" target="_blank" type="button" class="btn btn-custom"><i
                        class="fa-solid fa-file-word"></i> Criar
                    Documento
                </a> -->
            </div>
        </form>
        <div class="chat-container" id="chatContainer"></div>
    </div>

    <!-- Footer -->
    <!-- <footer>
        <p>
            <small>
                Conselho Federal de Nutrição &copy; 2025 - I.A de Resoluções.
            </small>
        </p>
    </footer> -->

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="js/ia.js"></script>
</body>

</html>