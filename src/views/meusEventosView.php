<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <?php if (isset($_SESSION['mensagem_sucesso'])): ?> 
    <div style="background-color: #d4edda; color: #155724; padding: 10px; margin-bottom: 15px; border: 1px solid #c3e6cb; border-radius: 5px;">
        <?= $_SESSION['mensagem_sucesso']; ?>
    </div>

    <?php unset($_SESSION['mensagem_sucesso']); ?>
    <?php endif; ?>

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
        <p>Voltar para a página inicial</p>
        <a href="/app-jabulani/listarEventos">Página Inicial</a>
    

</body>
</html>