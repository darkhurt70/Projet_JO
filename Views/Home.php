

<?php $this->layout('template', ['title' => 'Gensin Collection','gameName' => $gameName]) ?>
<?php if (!empty($message)) : ?>
    <div class="alert"><?= $this->e($message); ?></div>
<?php endif; ?>
<?php
if (isset($_GET['message']) && $_GET['message'] === 'update-success') {
    echo '<div class="alert">✅ Personnage mis à jour avec succès</div>';
}
?>



<div class="container">
    <?php foreach ($listPersonnage as $perso): ?>
        <?php
        $element = strtolower($perso->getElement());
        $rarity = "rarity-" . intval($perso->getRarity());
        ?>
        <div class="card <?= $this->e($element); ?> <?= $this->e($rarity); ?>">
            <img src="<?= $this->e($perso->getUrlImg()); ?>" alt="<?= $this->e($perso->getName()); ?>">
            <div style="padding: 10px;">
                <h4><?= $this->e($perso->getName()); ?></h4>
                <p>Élément : <?= $this->e($perso->getElement()); ?></p>
                <p>Classe : <?= $this->e($perso->getUnitclass()); ?></p>
                <p>Origine : <?= $this->e($perso->getOrigin()); ?></p>
                <p>Rareté : <?= $this->e($perso->getRarity()); ?>★</p>
                <div style="margin-top: 10px;">
                    <a href="index.php?action=edit-perso&id=<?= $perso->getId(); ?>">✏️</a>
                    <a href="index.php?action=del-perso&id=<?=$perso->getId(); ?>" class="delete-btn">
                        🗑️
                    </a>

                </div>
            </div>
        </div>
    <?php endforeach; ?>


</div>

