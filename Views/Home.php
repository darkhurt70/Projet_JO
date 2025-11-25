<?php $this->layout('template', ['title' => 'Genshin Collection', 'gameName' => $gameName]) ?>

<?php if (!empty($message)): ?>
    <?= $this->insert('message', ['message' => $message]) ?>
<?php endif; ?>

<?php if (isset($_GET['message']) && $_GET['message'] === 'update-success'): ?>
    <div class="alert">✅ Personnage mis à jour avec succès</div>
<?php endif; ?>



<div class="container">
    <?php foreach ($listPersonnage as $perso): ?>
        <?php
        $elementObj = $perso->getElement();
        $originObj = $perso->getOrigin();
        $unitclassObj = $perso->getUnitclass();

        $elementName = strtolower($elementObj->getName());
        $validElements = ['electro', 'pyro', 'hydro', 'cryo', 'anemo', 'geo', 'dendro'];
        $elementClass = in_array($elementName, $validElements) ? $elementName : 'neutre';

        $rarity = "rarity-" . intval($perso->getRarity());
        ?>
        <div class="card <?= $this->e($elementClass); ?> <?= $this->e($rarity); ?>">
            <img src="<?= $this->e($perso->getUrlImg()); ?>" alt="<?= $this->e($perso->getName()); ?>">
            <div style="padding: 10px;">
                <h4><?= $this->e($perso->getName()); ?></h4>
                <p class="inline-icon">
                    Élément :

                    <img src="<?= $this->e($elementObj->getUrlImg()); ?>"
                         alt="<?= $this->e($elementObj->getName()); ?>"
                         >
                </p>

                <p class="inline-icon">
                    Classe :

                    <img src="<?= $this->e($unitclassObj->getUrlImg()); ?>"
                         alt="<?= $this->e($unitclassObj->getName()); ?>"
                         >
                </p>

                <p class="inline-icon">
                    Origine :
                    <?= $this->e($originObj->getName()); ?>
                    <img src="<?= $this->e($originObj->getUrlImg()); ?>"
                         alt="<?= $this->e($originObj->getName()); ?>"
                        >
                </p>


                <p>Rareté : <?= $this->e($perso->getRarity()); ?>★</p>
                <div style="margin-top: 10px;">
                    <a href="index.php?action=edit-perso&id=<?= $perso->getId(); ?>">✏️</a>
                    <a href="index.php?action=del-perso&id=<?= $perso->getId(); ?>" class="delete-btn">🗑️</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

