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
        <?php
            foreach($listaEventos as $evento){?>
                <tr>
                <td><?=htmlspecialchars($evento['titulo'], ENT_QUOTES, 'UTF-8')?></td>
                <td><?=htmlspecialchars($evento['descricao'], ENT_QUOTES, 'UTF-8')?></td>
                <td><?=htmlspecialchars($evento['local'], ENT_QUOTES, 'UTF-8')?></td>
                <td><?=htmlspecialchars($evento['dataEvento'], ENT_QUOTES, 'UTF-8')?></td>
                    
                <td> <?php if (isset($_SESSION['admin_id'])): ?>
                    <form action="/app-jabulani/alterarEvento" method="post">
                        <input type="hidden" name="id" value="<?=htmlspecialchars($evento['id'], ENT_QUOTES, 'UTF-8')?>">
                        <input type="submit" value="Alterar">
                    </form>
                    <form action="/app-jabulani/excluirEvento" method="post">
                        <input type="hidden" name="id" value="<?=htmlspecialchars($evento['id'], ENT_QUOTES, 'UTF-8')?>">
                        <input type="submit" value="Excluir">
                    </form>
                    
                <?php elseif (isset($_SESSION['usuario_id'])): ?>
                    <td>
                        <form action="/app-jabulani/inscrever" method="post">
                            <input type="hidden" name="idEvento" value="<?=htmlspecialchars($evento['id'], ENT_QUOTES, 'UTF-8')?>">
                            <input type="submit" value="Participar">
                        </form>
                    </td>
                <?php endif; ?>
                </td>
                </tr>
            <?php
            }
        ?>

    </table>
    <?php if (isset($_SESSION['admin_id'])): ?>
        <p>Inserir um novo evento?</p>
        <a href="/app-jabulani/formInserirEvento">Inserir Evento</a>
    <?php endif; ?>
</body>
</html>