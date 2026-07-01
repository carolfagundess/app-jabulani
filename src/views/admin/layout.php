<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h1 class="h4"><?=htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?></h1>
                <p><?=htmlspecialchars($content, ENT_QUOTES, 'UTF-8'); ?></p>
            </div>
        </div>
    </div>
</body>
</html>