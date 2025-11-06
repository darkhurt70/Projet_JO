<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= $this->e($title ?? 'Page') ?></title>
    <link rel="stylesheet" href="/public/css/main.css">
</head>
<body>

<header>
    <nav>
        <a href="index.php">Accueil</a> |
        <a href="index.php?action=add-perso">Ajouter un personnage</a>
    </nav>
</header>

<main>
    <?= $this->section('content') ?>
</main>

</body>
</html>
