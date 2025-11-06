
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" href="public/css/main.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Cardo&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $this->e($title) ?></title>
</head>


<body>
<header>
    <nav>
        <h1 class="genshin-title"> <?= $this->e($gameName) ?></h1>

        <ul style="display: flex; gap: 10px; list-style: none;">
            <li><a href="index.php">Accueil</a></li>
            <li><a href="index.php?action=add-perso">Ajouter un perso</a></li>
            <li><a href="index.php?action=add-perso-element">Ajouter un élément</a></li>
            <li><a href="index.php?action=logs">Logs</a></li>
            <li><a href="index.php?action=login">Connexion</a></li>
        </ul>
    </nav>
</header>

<!-- #contenu -->
<main id="contenu">
    <?=$this->section('content')?>
</main>
<footer>
</footer>
</body>
</html>