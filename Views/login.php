<?php
$this->layout('template', [
        'title' => 'Connexion',
        'gameName' => 'Connexion Genshin'
]);
?>

<h1 class="genshin-title">🔐 Connexion</h1>

<?php if (!empty($message)): ?>
    <?= $this->insert('message', ['message' => $message]) ?>
<?php endif; ?>

<form method="post" action="index.php?action=login" class="form-genshin" style="max-width: 400px; margin: auto;">
    <label for="username">Nom d'utilisateur :</label>
    <input type="text" id="username" name="username" required placeholder="Nom d’utilisateur">

    <label for="password">Mot de passe :</label>
    <input type="password" id="password" name="password" required placeholder="Mot de passe">

    <br><br>
    <button type="submit" class="btn-genshin">Se connecter</button>
</form>
