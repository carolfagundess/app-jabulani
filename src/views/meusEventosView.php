<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventos em que estou inscrito</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <?php if (isset($_SESSION['mensagem_sucesso'])): ?>
            <div class="alert alert-success">
                <?= htmlspecialchars($_SESSION['mensagem_sucesso'], ENT_QUOTES, 'UTF-8') ?>
            </div>
            <?php unset($_SESSION['mensagem_sucesso']); ?>
        <?php endif; ?>

        <div class="card shadow-sm">
            <div class="card-body">
                <h1 class="h4 mb-4">Eventos em que estou inscrito</h1>
                <div class="table-responsive">
                    <table class="table table-striped align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Título</th>
                                <th>Descrição</th>
                                <th>Data</th>
                                <th>Local</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($listaEventos as $evento): ?>
                                <tr>
                                    <td><?=htmlspecialchars($evento['titulo'], ENT_QUOTES, 'UTF-8')?></td>
                                    <td><?=htmlspecialchars($evento['descricao'], ENT_QUOTES, 'UTF-8')?></td>
                                    <td><?=htmlspecialchars($evento['dataEvento'], ENT_QUOTES, 'UTF-8')?></td>
                                    <td><?=htmlspecialchars($evento['local'], ENT_QUOTES, 'UTF-8')?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    <a href="/app-jabulani/listarEventos" class="btn btn-primary">Página Inicial</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>