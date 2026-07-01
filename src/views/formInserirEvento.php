<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Eventos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h1 class="h4 mb-4">Formulário de cadastro de Eventos</h1>
                        <form action="<?= htmlspecialchars($acao, ENT_QUOTES, 'UTF-8') ?>" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label class="form-label">Título</label>
                                <input type="text" name="titulo" class="form-control" value="<?= isset($titulo) ? htmlspecialchars($titulo, ENT_QUOTES, 'UTF-8') : '' ?>">
                            </div>

                            <?php if (isset($auxId)): ?>
                                <input type="hidden" name="id" value="<?= htmlspecialchars($auxId, ENT_QUOTES, 'UTF-8') ?>">
                            <?php endif; ?>

                            <div class="mb-3">
                                <label class="form-label">Descrição</label>
                                <input type="text" name="descricao" class="form-control" value="<?= isset($descricao) ? htmlspecialchars($descricao, ENT_QUOTES, 'UTF-8') : '' ?>">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Local</label>
                                <input type="text" name="local" class="form-control" value="<?= isset($local) ? htmlspecialchars($local, ENT_QUOTES, 'UTF-8') : '' ?>">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Data</label>
                                <input type="date" name="dataEvento" class="form-control" value="<?= isset($dataEvento) ? htmlspecialchars($dataEvento, ENT_QUOTES, 'UTF-8') : '' ?>">
                            </div>

                            <button type="submit" class="btn btn-primary">Registrar</button>
                            <a href="/app-jabulani/listarEventos" class="btn btn-secondary ms-2">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>