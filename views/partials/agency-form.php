<h1 class="mb-3"><?= htmlspecialchars($submitTitle ?? 'Agence') ?></h1>
<form class="container mt-4" action="<?= htmlspecialchars($action ?? '/agences/ajouter') ?>" method="POST">

<?php if (isset($agency['id'])): ?>
    <input type="hidden" name="id" value="<?= htmlspecialchars($agency['id']) ?>">
<?php endif; ?>

  <div class="row">

    <!-- Colonne droite : Arrivée -->
    <div class="col-md-12">

      <div class="mb-3">
        <label for="InputCity2" class="form-label">Agence</label>
        <input type="text" class="form-control" id="InputCity2" value="<?= htmlspecialchars($agency['name'] ?? '') ?>">
      </div>
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