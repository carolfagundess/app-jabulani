<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Login</title>
</head>

<body>
    <fieldset>
<<<<<<< HEAD:src/views/admin/formLogin.php
        <form action="/app-jabulani/autenticar" method="post">
=======
        <form action="/app-jabulani/<?=htmlspecialchars($acao, ENT_QUOTES, 'UTF-8')?>" method="post">
>>>>>>> ccac9c18fec9b9ce00c6db49189a2420f096f412:src/views/formLogin.php
            <label for="email">Email:</label>
            <input type="text" name="email" required><br><br>
            <label for="senha">Senha:</label>
            <input type="password" name="senha" required><br><br>
            <input type="submit" value="Entrar">
        </form>
    </fieldset>
</body>

</html>