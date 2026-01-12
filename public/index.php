<?php include __DIR__ . '/../bootstrap/app.php'; ?>

<!DOCTYPE html>
<html <?php include __DIR__ . '/../views/tag-html.php'; ?>>

<head>
    <?php include __DIR__ . '/../views/head.php'; ?>
    <link rel="stylesheet" href="/css/app.css">
</head>

<body <?php include __DIR__ . '/../views/tag-body.php'; ?>>
    <?php include __DIR__ . '/../views/header.php'; ?>
    <?php $page->body() ?>
    <?php include __DIR__ . '/../views/footer.php'; ?>
    <script type="module" src="/js/app.js"></script>
</body>

</html>