<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Lista de Eventos</h1>
    <table border="">
        <?php foreach ($listaEventos as $evento): ?>
            <tr>
                <td><?= $evento['titulo'] ?></td>
                <td><?= $evento['descricao'] ?></td>
                <td><?= $evento['local'] ?></td>
                <td><?= $evento['dataEvento'] ?></td>

                <?php if (isset($_SESSION['admin_id'])): ?>
                    <td>
                        <form action="/app-jabulani/alterarEvento" method="post" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $evento['id'] ?>">
                            <input type="submit" value="Alterar">
                        </form>
                        <form action="/app-jabulani/excluirEvento" method="post" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $evento['id'] ?>">
                            <input type="submit" value="Excluir">
                        </form>
                    </td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>

        <?php if (isset($_SESSION['usuario_id'])): ?>
            <td>
                <form action="/app-jabulani/inscreverEvento" method="post">
                    <input type="hidden" name="id_evento"
                        value="<?= htmlspecialchars($evento['id'], ENT_QUOTES, 'UTF-8') ?>">
                    <input type="submit" value="Inscrever-se">
                </form>
            </td>
        <?php endif; ?>

    </table>
    <p>Inserir um novo evento?</p>
    <a href="/app-jabulani/formInserirEvento">Inserir Evento</a>
</body>

</html>