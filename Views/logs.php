<?php
$this->layout('template', [
        'title' => 'Logs',
        'gameName' => $gameName ?? 'Genshin Impact'
]);
?>


<h1 class="genshin-title">📜 Journal des modifications</h1>

<form method="get" action="index.php" class="form-genshin" style="margin-bottom: 20px;">
    <input type="hidden" name="action" value="show-log">

    <label for="log-select">Sélectionner un mois :</label>
    <select name="file" id="log-select" class="input-genshin">
        <?php foreach ($logFiles as $f): ?>
            <option value="<?= $this->e($f) ?>" <?= isset($selectedFile) && $selectedFile === $f ? 'selected' : '' ?>>
                <?= $this->e($f) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <button type="submit" class="btn-genshin">📂 Afficher</button>
</form>

<?php if (isset($logContent)): ?>
    <div class="log-container">
        <h3>🗂️ Fichier sélectionné : <?= $this->e($selectedFile) ?></h3>
        <textarea readonly rows="20" style="width: 100%; font-family: monospace;"><?= $this->e($logContent) ?></textarea>
    </div>
<?php endif; ?>
