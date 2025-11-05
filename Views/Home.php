<?php
$this->layout('template', ['title' => 'TP Mihoyo']);
?>
<h1>Collection <?= $this->e($gameName) ?></h1>

<h2>Affichage brut (debug)</h2>
<pre>
<?php var_dump($listPersonnage); ?>
<?php var_dump($first); ?>
<?php var_dump($other); ?>
</pre>
