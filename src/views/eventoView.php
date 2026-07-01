<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Eventos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">Lista de Eventos</h1>
            <?php if (isset($_SESSION['usuario_id']) || isset($_SESSION['admin_id'])): ?>
                <div>
                    <a href="/app-jabulani/perfil" class="btn btn-outline-primary btn-sm">Editar Perfil</a>
                    <?php if (isset($_SESSION['usuario_id'])): ?>
                        <a href="/app-jabulani/meusEventos" class="btn btn-outline-secondary btn-sm">Meus Eventos</a>
                    <?php endif; ?>
                    <a href="/app-jabulani/logout" class="btn btn-outline-danger btn-sm">Sair</a>
                </div>
            <?php endif; ?>
        </div>

        <?php if (!empty($_SESSION['mensagem_sucesso'])): ?>
            <div class="alert alert-success"><?= htmlspecialchars($_SESSION['mensagem_sucesso'], ENT_QUOTES, 'UTF-8') ?></div>
            <?php unset($_SESSION['mensagem_sucesso']); ?>
        <?php endif; ?>

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Título</th>
                                <th>Descrição</th>
                                <th>Local</th>
                                <th>Data</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($listaEventos as $evento): ?>
                                <tr>
                                    <td><?= htmlspecialchars($evento['titulo'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars($evento['descricao'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars($evento['local'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars($evento['dataEvento'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td>
                                        <div class="d-flex flex-wrap gap-2">
                                            <?php if (isset($_SESSION['admin_id'])): ?>
                                                <form action="/app-jabulani/alterarEvento" method="post">
                                                    <input type="hidden" name="id" value="<?= htmlspecialchars($evento['id'], ENT_QUOTES, 'UTF-8') ?>">
                                                    <button class="btn btn-sm btn-warning" type="submit">Alterar</button>
                                                </form>
                                                <form action="/app-jabulani/excluirEvento" method="post">
                                                    <input type="hidden" name="id" value="<?= htmlspecialchars($evento['id'], ENT_QUOTES, 'UTF-8') ?>">
                                                    <button class="btn btn-sm btn-danger" type="submit">Excluir</button>
                                                </form>
                                                <form action="/app-jabulani/detalhesEvento" method="get">
                                                    <input type="hidden" name="id" value="<?= htmlspecialchars($evento['id'], ENT_QUOTES, 'UTF-8') ?>">
                                                    <button class="btn btn-sm btn-info text-white" type="submit">Ver Detalhes</button>
                                                </form>
                                                <form action="/app-jabulani/exportarEventoXml" method="get">
                                                    <input type="hidden" name="id" value="<?= htmlspecialchars($evento['id'], ENT_QUOTES, 'UTF-8') ?>">
                                                    <button class="btn btn-sm btn-outline-dark" type="submit">XML</button>
                                                </form>
                                                <form action="/app-jabulani/exportarEventoPdf" method="get">
                                                    <input type="hidden" name="id" value="<?= htmlspecialchars($evento['id'], ENT_QUOTES, 'UTF-8') ?>">
                                                    <button class="btn btn-sm btn-outline-secondary" type="submit">PDF</button>
                                                </form>
                                            <?php elseif (isset($_SESSION['usuario_id'])): ?>
                                                <form action="/app-jabulani/inscrever" method="post">
                                                    <input type="hidden" name="idEvento" value="<?= htmlspecialchars($evento['id'], ENT_QUOTES, 'UTF-8') ?>">
                                                    <button class="btn btn-sm btn-success" type="submit">Participar</button>
                                                </form>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <?php if (isset($_SESSION['admin_id'])): ?>
            <div class="mt-3">
                <a href="/app-jabulani/formInserirEvento" class="btn btn-primary">Inserir Evento</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>