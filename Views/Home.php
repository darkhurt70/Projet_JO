<?php
//$this->layout('template', ['title' => 'TP Mihoyo']);
//?>
<!--<h1>Collection --><?php //= $this->e($gameName) ?><!--</h1>-->
<!---->
<!--<h2>Affichage brut (debug)</h2>-->
<!--<pre>-->
<?php //var_dump($listPersonnage); ?>
<?php //var_dump($first); ?>
<?php //var_dump($other); ?>
<!--</pre>-->

<?php $this->layout('template', ['title' => 'TP Mihoyo']) ?>
<?php if (!empty($message)) : ?>
    <div class="alert"><?= $this->e($message); ?></div>
<?php endif; ?>


<h1>Collection <?= $this->e($gameName) ?></h1>

<div class="container">
    <div class="row">
        <?php foreach ($listPersonnage as $perso): ?>
            <div class="card" style="width: 200px; margin: 10px; border: 1px solid #ccc; border-radius: 10px; overflow: hidden;">
                <img src="<?= $perso->getUrlImg(); ?>" alt="<?= $this->e($perso->getName()); ?>" style="width: 100%; height: auto;">
                <div style="padding: 10px;">
                    <h4><?= $this->e($perso->getName()); ?></h4>
                    <p>Élément : <?= $this->e($perso->getElement()); ?></p>
                    <p>Classe : <?= $this->e($perso->getUnitclass()); ?></p>
                    <p>Origine : <?= $this->e($perso->getOrigin()); ?></p>
                    <p>Rareté : <?= $this->e($perso->getRarity()); ?>★</p>

                    <!-- Actions -->
                    <div style="margin-top: 10px;">
                        <a href="index.php?action=edit-perso&id=<?= $perso->getId(); ?>">✏️</a>
                        <a href="index.php?action=del-perso&id=<?= $perso->getId(); ?>">🗑️</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
