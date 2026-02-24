<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Touche Pas au Klaxon' ?> </title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/c0df283285.js" crossorigin="anonymous"></script>
    <script src="/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body class="d-flex flex-column min-vh-100">
    <header>
        <?php require __DIR__ . '/header.php'; ?>
    </header>

    <main class="container my-5 flex-grow-1">
        <?= $content ?>
    </main>
    <footer class="mt-auto bg-light">
        <?php require __DIR__ . '/footer.php'; ?>
    </footer>
</body>
</html>