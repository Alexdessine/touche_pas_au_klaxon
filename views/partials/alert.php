<?php if (isset($alert)) : ?>
    <div class="alert alert-<?= htmlspecialchars($messageType?? 'info') ?> alert-dismissible fade show" role="alert">
        <?= htmlspecialchars($alert ?? 'Elément supprimé avec succès') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>