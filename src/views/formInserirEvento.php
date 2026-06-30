<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Formulário Eventos</title>
</head>
<body>
    <fieldset>
        <legend>Formulário de cadastro de Eventos</legend>
        <form action="<?=$acao?>" method="post" enctype="multipart/form-data">
            <label>Título:</label>
            <input type="text" name="titulo" value="<?=isset($titulo)?$titulo:''?>">
            <br>

            <?php if(isset($auxId)){ ?>
                <input type="hidden" name="id" value="<?=$auxId?>">
            <?php } 
            ?>

            <label>Descrição:</label>
            <input type="text" name="descricao" value="<?=isset($descricao)?$descricao:''?>">
            <br>
            <label>Local:</label>
            <input type="text" name="local" value="<?=isset($local)?$local:''?>">
            <br>
            <label>Data:</label>
            <input type="date" name="dataEvento" value="<?=isset($dataEvento)?$dataEvento:''?>">
            <br>
            <label>Imagem:</label>
            <input type="file" name="banner" accept="image/*"><br><br>
            <input type="hidden" name="id" value="<?=isset($auxId)?$auxId:''?>">  
            <input type="submit" value="Registrar">  

        </form>
    </fieldset>
</body>
</html>