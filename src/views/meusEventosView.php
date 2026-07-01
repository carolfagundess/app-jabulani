<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Eventos em que estou inscrito</h1>
    <table border="1">
        <tr>
            <th>Título</th>
            <th>Descrição</th>
            <th>Data</th>
            <th>Local</th>
        </tr>
        <?php foreach($listaEventos as $evento): ?>
            <tr>
                <td><?=htmlspecialchars($evento['titulo'], ENT_QUOTES, 'UTF-8')?></td>
                <td><?=htmlspecialchars($evento['descricao'], ENT_QUOTES, 'UTF-8')?></td>
                <td><?=htmlspecialchars($evento['dataEvento'], ENT_QUOTES, 'UTF-8')?></td>
                <td><?=htmlspecialchars($evento['local'], ENT_QUOTES, 'UTF-8')?></td>
            </tr>
        <?php endforeach; ?>
    </table>

</body>
</html>