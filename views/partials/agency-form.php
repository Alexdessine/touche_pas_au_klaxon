<h1 class="mb-3"><?= htmlspecialchars($submitTitle ?? 'Agence') ?></h1>
<form class="container mt-4" action="<?= htmlspecialchars($action ?? '/agences/ajouter') ?>" method="POST">

<?php if (isset($agency['id'])): ?>
    <input type="hidden" name="id" value="<?= htmlspecialchars((string)($agency['id'])) ?>">
<?php endif; ?>

  <div class="row">

    <!-- Colonne droite : Arrivée -->
    <div class="col-md-12">

      <div class="mb-3">
        <label for="agencyName" class="form-label">Agence</label>
        <input type="text" class="form-control" id="agencyName" name="name"
              value="<?= htmlspecialchars((string)($agency['name'] ?? '')) ?>"
              required maxlength="190">

        <?php if (!empty($errors['name'])): ?>
          <div class="text-danger mt-1">
            <?= htmlspecialchars($errors['name']) ?>
          </div>
        <?php endif; ?>
      </div>


  </div>

  <!-- Bouton centré -->
  <div class="row mt-4">
    <div class="col text-center">
        <button type="submit" class="btn btn-primary px-4">
          <?=  htmlspecialchars($submitLabel ?? 'Enregistrer') ?>
        </button>
    </div>
  </div>

</form>