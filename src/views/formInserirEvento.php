<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Formulário Eventos</title>
</head>
<body>
    <fieldset>
        <legend>Formulário de cadastro de Eventos</legend>
        <form action="<?=htmlspecialchars($acao, ENT_QUOTES, 'UTF-8')?>" method="post">
            <label>Título:</label>
            <input type="text" name="titulo" value="<?=isset($titulo)?htmlspecialchars($titulo, ENT_QUOTES, 'UTF-8'):''?>">
            <br>

            <?php if(isset($auxId)){ ?>
                <input type="hidden" name="id" value="<?=htmlspecialchars($auxId, ENT_QUOTES, 'UTF-8')?>">
            <?php } 
            ?>

            <label>Descrição:</label>
            <input type="text" name="descricao" value="<?=isset($descricao)?htmlspecialchars($descricao, ENT_QUOTES, 'UTF-8'):''?>">
            <br>
            <label>Local:</label>
            <input type="text" name="local" value="<?=isset($local)?htmlspecialchars($local, ENT_QUOTES, 'UTF-8'):''?>">
            <br>
            <label>Data:</label>
            <input type="date" name="dataEvento" value="<?=isset($dataEvento)?htmlspecialchars($dataEvento, ENT_QUOTES, 'UTF-8'):''?>">
            <br>
            <input type="hidden" name="id" value="<?=isset($auxId)?htmlspecialchars($auxId, ENT_QUOTES, 'UTF-8'):''?>">  
            <input type="submit" value="Registrar">  

        </form>
    </fieldset>
</body>
</html>