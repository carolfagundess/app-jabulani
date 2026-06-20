<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Usuário</title>
</head>
<body>
    <fieldset>
        <legend>Criar nova conta</legend>
        <form action="/app-jabulani/<?=$acao?>" method="post">
            <label for="nomeUsuario">Nome de Usuário:</label>
            <input type="text" name="nomeUsuario" required><br><br>

            <label for="email">E-mail:</label>
            <input type="email" name="email" required><br><br>

            <label for="senha">Senha:</label>
            <input type="password" name="senha" required><br><br>
            <label for="confirmarSenha">Confirmar Senha:</label>
            <input type="password" name="confirmarSenha" required><br><br>
            <label for="telefone">Telefone:</label>
            <input type="tel" name="telefone" placeholder="(XX) XXXXX-XXXX" required><br><br>

            <input type="submit" value="Cadastrar">
        </form>
    </fieldset>
    <a href="/app-jabulani/login">Já tenho conta (Login)</a>
</body>
</html>