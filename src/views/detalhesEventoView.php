<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Evento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h1 class="h4 mb-4">Detalhes do Evento</h1>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <p><strong>Título:</strong> <?= htmlspecialchars($evento['titulo'], ENT_QUOTES, 'UTF-8') ?></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Data:</strong> <?= htmlspecialchars($evento['dataEvento'], ENT_QUOTES, 'UTF-8') ?></p>
                    </div>
                </div>
                <p><strong>Descrição:</strong> <?= htmlspecialchars($evento['descricao'], ENT_QUOTES, 'UTF-8') ?></p>
                <p><strong>Local:</strong> <?= htmlspecialchars($evento['local'], ENT_QUOTES, 'UTF-8') ?></p>

                <h2 class="h5 mt-4">Participantes inscritos</h2>
                <?php if (!empty($participantes)): ?>
                    <ul class="list-group mt-3">
                        <?php foreach ($participantes as $participante): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <?= htmlspecialchars($participante['nomeUsuario'], ENT_QUOTES, 'UTF-8') ?>
                                    <span class="text-muted">- <?= htmlspecialchars($participante['email'], ENT_QUOTES, 'UTF-8') ?></span>
                                </div>
                                <?php if (isset($_SESSION['admin_id'])): ?>
                                    <div class="d-flex gap-2">
                                        <form action="/app-jabulani/removerParticipante" method="post" class="m-0">
                                            <input type="hidden" name="idUsuario" value="<?= htmlspecialchars($participante['idUsuario'], ENT_QUOTES, 'UTF-8') ?>">
                                            <input type="hidden" name="idEvento" value="<?= htmlspecialchars($evento['id'], ENT_QUOTES, 'UTF-8') ?>">
                                            <button type="submit" class="btn btn-sm btn-warning">Remover do Evento</button>
                                        </form>
                                        <form action="/app-jabulani/excluirUsuario" method="post" class="m-0">
                                            <input type="hidden" name="idUsuario" value="<?= htmlspecialchars($participante['idUsuario'], ENT_QUOTES, 'UTF-8') ?>">
                                            <input type="hidden" name="redirectTo" value="/app-jabulani/detalhesEvento?id=<?= htmlspecialchars($evento['id'], ENT_QUOTES, 'UTF-8') ?>">
                                            <button type="submit" class="btn btn-sm btn-danger">Excluir do Sistema</button>
                                        </form>
                                    </div>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <div class="alert alert-secondary mt-3">Nenhum participante inscrito ainda.</div>
                <?php endif; ?>

                <div class="mt-4">
                    <a href="/app-jabulani/exportarEventoXml?id=<?= htmlspecialchars($evento['id'], ENT_QUOTES, 'UTF-8') ?>" class="btn btn-outline-dark btn-sm">Baixar XML</a>
                    <a href="/app-jabulani/exportarEventoPdf?id=<?= htmlspecialchars($evento['id'], ENT_QUOTES, 'UTF-8') ?>" class="btn btn-outline-secondary btn-sm">Baixar PDF</a>
                    <a href="/app-jabulani/listarEventos" class="btn btn-primary btn-sm">Voltar</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
