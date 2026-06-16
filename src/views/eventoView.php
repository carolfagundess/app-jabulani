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
                <td><?=$evento['titulo']?></td>
                <td><?=$evento['descricao']?></td>
                <td><?=$evento['local']?></td>
                <td><?=$evento['dataEvento']?></td>
                <td>
                    <form action="/app-jabulani/alterarEvento" method="post">
                        <input type="hidden" name="id" value="<?=$evento['id']?>">
                        <input type="submit" value="Alterar">
                    </form>
                </td>
                </tr>
            <?php
            }
        ?>

    </table>
    <p>Inserir um novo evento?</p>
    <a href = "/app-jabulani/formInserirEvento">Inserir Evento</a>
</body>
</html>