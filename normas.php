<?php
// Conexão com o banco de dados
$host = 'easypanel.moraiscode.com';
$dbname = 'jurisprudencia';
$username = 'jurisprudencia';
$password = '@5Wl17ru9';

try {
    $pdo = new PDO("mysql:host=$host;port=33061;dbname=$dbname", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_TIMEOUT => 10 // Aumenta o timeout para 10 segundos
    ]);
    $stmt = $pdo->query("SELECT id, titulo, ano, criado_em, observacao FROM documentos");
    $normas = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jurisprudência - Lista de Normas</title>
    <meta name="description" content="Consulte a lista completa de normas jurídicas cadastradas no sistema Jurisprudência. Inclui detalhes como ano, upload e observações.">
    <meta name="keywords" content="normas jurídicas, jurisprudência, documentos legais, lista de normas, consulta de normas">
    <meta name="author" content="xAI">
    <meta name="robots" content="index, follow">
    <meta name="language" content="pt-BR">
    <meta property="og:title" content="Jurisprudência - Lista de Normas">
    <meta property="og:description" content="Acesse a lista de normas jurídicas no sistema Jurisprudência. Visualize e gerencie documentos legais com facilidade.">
    <meta property="og:image" content="otg.png">
    <meta property="og:url" content="https://easypanel.moraiscode.com/normas.php">
    <meta property="og:type" content="website">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="Jurisprudência - Lista de Normas">
    <meta name="twitter:description" content="Explore e gerencie normas jurídicas no sistema Jurisprudência. Consulte detalhes e exclua documentos com segurança.">
    <meta name="twitter:image" content="otg.png">

    <link rel="icon" type="image/png" href="favicon/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="favicon/favicon.svg" />
    <link rel="shortcut icon" href="favicon/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png" />
    <meta name="apple-mobile-web-app-title" content="Juris" />
    <link rel="manifest" href="favicon/site.webmanifest" />

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <!-- Google Fonts (Roboto) -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            background-color: #f8f9fa;
        }
        .table-container {
            width: 90%;
            max-width: 1200px;
            margin-top: 5%;
            margin-bottom: 5%;
        }
        .dataTables_wrapper {
            width: 100%;
        }
        .btn-sm {
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <div class="table-container">
        <table id="normasTable" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Norma</th>
                    <th>Ano</th>
                    <th>Upload</th>
                    <th>Observação</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($normas as $norma): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($norma['titulo']); ?></td>
                        <td><?php echo htmlspecialchars($norma['ano']); ?></td>
                        <td><?php echo date('d/m/Y', strtotime($norma['criado_em'])); ?></td>
                        <td><?php echo htmlspecialchars($norma['observacao']); ?></td>
                        <td>
                            <button class="btn btn-danger btn-sm delete-btn" data-id="<?php echo $norma['id']; ?>">Excluir</button>
                            <!-- <button class="btn btn-primary btn-sm edit-btn" data-id="<?php echo $norma['id']; ?>">Editar</button> -->
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#normasTable').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json'
                },
                pageLength: 10,
                responsive: true
            });

            // Excluir registro via AJAX
            $('.delete-btn').on('click', function() {
                if (confirm('Tem certeza que deseja excluir esta norma?')) {
                    const id = $(this).data('id');
                    $.ajax({
                        url: 'delete_norma.php',
                        type: 'POST',
                        data: { id: id },
                        success: function(response) {
                            if (response === '"success"') {
                                $(this).closest('tr').remove();
                                $('#normasTable').DataTable().row($(this).parents('tr')).remove().draw();
                            } else {
                                alert('Erro ao excluir a norma.');
                            }
                        }.bind(this),
                        error: function() {
                            alert('Erro na requisição.');
                        }
                    });
                }
            });

            // Editar (placeholder por enquanto)
            $('.edit-btn').on('click', function() {
                // Nada será feito por enquanto
            });
        });
    </script>
</body>
</html>