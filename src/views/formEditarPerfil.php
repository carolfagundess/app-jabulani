<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <fieldset>
        <legend>Editar os meus dados</legend>
        <form action="/app-jabulani/salvarPerfil" method="post">
            <input type="hidden" name="idUsuario" value="<?=htmlspecialchars($usuario['idUsuario'], ENT_QUOTES, 'UTF-8')?>">
            <label>Nome:</label>
            <input type="text" name="nomeUsuario" value="<?=htmlspecialchars($usuario['nomeUsuario'], ENT_QUOTES, 'UTF-8')?>"><br><br>
            <label>E-mail:</label>
            <input type="email" name="email" value="<?=htmlspecialchars($usuario['email'], ENT_QUOTES, 'UTF-8')?>"><br><br>
            <input type="submit" value="Salvar Alterações">
        </form>
    </fieldset>
</body>
</html>