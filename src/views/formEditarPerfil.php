<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <?php if (!empty($_SESSION['mensagem_sucesso'])): ?>
                            <div class="alert alert-success">
                                <?= htmlspecialchars($_SESSION['mensagem_sucesso'], ENT_QUOTES, 'UTF-8') ?>
                            </div>
                            <?php unset($_SESSION['mensagem_sucesso']); ?>
                        <?php endif; ?>
                        <h1 class="h4 mb-4">Editar Perfil</h1>
                        <form action="/app-jabulani/salvarPerfil" method="post">
                            <input type="hidden" name="idUsuario" value="<?= htmlspecialchars($usuario['idUsuario'], ENT_QUOTES, 'UTF-8') ?>">
                            <div class="mb-3">
                                <label class="form-label">Nome</label>
                                <input type="text" class="form-control" name="nomeUsuario" value="<?= htmlspecialchars($usuario['nomeUsuario'], ENT_QUOTES, 'UTF-8') ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">E-mail</label>
                                <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($usuario['email'], ENT_QUOTES, 'UTF-8') ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Telefone</label>
                                <input type="text" class="form-control" name="telefone" value="<?= htmlspecialchars($usuario['telefone'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                            </div>
                            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                            <a href="/app-jabulani/listarEventos" class="btn btn-outline-secondary ms-2">Voltar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>