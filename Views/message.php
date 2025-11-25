<div class="alert <?= $this->e($message->getColor()) ?>">
    <strong><?= $this->e($message->getTitle()) ?> :</strong>
    <?= $this->e($message->getContent()) ?>
</div>
