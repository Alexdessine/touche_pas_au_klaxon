<h1>Ajouter un trajet</h1>

<div class="border border-2 border-success-subtle rounded p-2 my-4 w-50 shadow-sm">
    <p>
        Trajet proposé par
        <span class="fw-bold">
            <?= htmlspecialchars(($user?->getFirstname() ?? '') . ' ' . ($user?->getLastname() ?? '')) ?>
        </span>
    </p>

    <p>
        Téléphone :
        <span class="fw-bold">
            <?php $phone = $user?->getPhone() ?? ''; ?>
            <?php if ($phone !== ''): ?>
                <a href="tel:<?= htmlspecialchars($phone) ?>" class="text-decoration-none text-black-50">
                    <?= htmlspecialchars($phone) ?>
                </a>
            <?php endif; ?>
        </span>
    </p>

    <p class="mb-0">
        Email :
        <span class="fw-bold">
            <?php $email = $user?->getEmail() ?? ''; ?>
            <?php if ($email !== ''): ?>
                <a href="mailto:<?= htmlspecialchars($email) ?>" class="text-decoration-none text-black-50">
                    <?= htmlspecialchars($email) ?>
                </a>
            <?php endif; ?>
        </span>
    </p>
</div>

<?php require_once __DIR__ . '/../partials/alert.php'; ?>

<?php if (!empty($errors['form'])): ?>
  <div class="alert alert-danger"><?= htmlspecialchars($errors['form']) ?></div>
<?php endif; ?>

<?php require_once __DIR__ . '/../partials/trips-form.php'; ?>