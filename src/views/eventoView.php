<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Eventos</title>
</head>
<body>
    <h1>Lista de Eventos</h1>
    <table border="1">
        <tr>
            <th>Título</th>
            <th>Descrição</th>
            <th>Local</th>
            <th>Data</th>
            <th>Ações</th>
        </tr>
        <?php foreach ($listaEventos as $evento): ?>
            <tr>
                <td><?= htmlspecialchars($evento['titulo'], ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($evento['descricao'], ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($evento['local'], ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($evento['dataEvento'], ENT_QUOTES, 'UTF-8') ?></td>
                
                <td>
                    <?php if (isset($_SESSION['admin_id'])): ?>
                        <form action="/app-jabulani/alterarEvento" method="post" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $evento['id'] ?>">
                            <input type="submit" value="Alterar">
                        </form>
                        <form action="/app-jabulani/excluirEvento" method="post" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $evento['id'] ?>">
                            <input type="submit" value="Excluir">
                        </form>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['usuario_id'])): ?>
                        <form action="/app-jabulani/inscreverEvento" method="post" style="display:inline;">
                            <input type="hidden" name="id_evento" value="<?= $evento['id'] ?>">
                            <input type="submit" value="Inscrever-se">
                        </form>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <?php if (isset($_SESSION['admin_id'])): ?>
        <p>Inserir um novo evento?</p>
        <a href="/app-jabulani/formInserirEvento">Inserir Evento</a>
    <?php endif; ?>
</body>
</html>