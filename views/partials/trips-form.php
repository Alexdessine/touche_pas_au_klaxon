<form class="container mt-4" action="<?= htmlspecialchars($action ?? '/trajets/ajouter') ?>" method="POST">
  <?php $errors = $errors ?? []; ?>

  <?php if (!empty($trip['id'])): ?>
    <input type="hidden" name="id" value="<?= htmlspecialchars((string)$trip['id']) ?>">
  <?php endif; ?>

  <div class="row">

    <div class="col-md-6">
      <h4 class="mb-3">Départ</h4>

      <div class="mb-3">
        <label for="departureAgency" class="form-label">Agence</label>
        <select class="form-select" id="departureAgency" name="departure_agency_id" required>
          <option value="">Sélectionnez une agence</option>
          <?php foreach ($agencies as $agency): ?>
            <option
              value="<?= htmlspecialchars((int)$agency->getId()) ?>"
              <?= isset($trip['departure_agency_id']) && (string)$trip['departure_agency_id'] === (string)$agency->getId() ? 'selected' : '' ?>
            >
              <?= htmlspecialchars($agency->getName()) ?>
            </option>
          <?php endforeach; ?>
        </select>
        <?php if (!empty($errors['departure_agency_id'])): ?>
          <div class="text-danger mt-1"><?= htmlspecialchars($errors['departure_agency_id']) ?></div>
        <?php endif; ?>
      </div>

      <div class="mb-3">
        <label for="departureDate" class="form-label">Date</label>
        <input type="date" class="form-control" id="departureDate" name="departure_date"
               value="<?= htmlspecialchars((string)($trip['departure_date'] ?? '')) ?>" required>
        <?php if (!empty($errors['departure_date'])): ?>
          <div class="text-danger mt-1"><?= htmlspecialchars($errors['departure_date']) ?></div>
        <?php endif; ?>
      </div>

      <div class="mb-3">
        <label for="departureTime" class="form-label">Heure</label>
        <input type="time" class="form-control" id="departureTime" name="departure_time"
               value="<?= htmlspecialchars((string)($trip['departure_time'] ?? '')) ?>" required>
        <?php if (!empty($errors['departure_time'])): ?>
          <div class="text-danger mt-1"><?= htmlspecialchars($errors['departure_time']) ?></div>
        <?php endif; ?>
      </div>
    </div>

    <div class="col-md-6">
      <h4 class="mb-3">Arrivée</h4>

      <div class="mb-3">
        <label for="arrivalAgency" class="form-label">Agence</label>
        <select class="form-select" id="arrivalAgency" name="arrival_agency_id" required>
          <option value="">Sélectionnez une agence</option>
          <?php foreach ($agencies as $agency): ?>
            <option
              value="<?= htmlspecialchars((int)$agency->getId()) ?>"
              <?= isset($trip['arrival_agency_id']) && (string)$trip['arrival_agency_id'] === (string)$agency->getId() ? 'selected' : '' ?>
            >
              <?= htmlspecialchars($agency->getName()) ?>
            </option>
          <?php endforeach; ?>
        </select>
        <?php if (!empty($errors['arrival_agency_id'])): ?>
          <div class="text-danger mt-1"><?= htmlspecialchars($errors['arrival_agency_id']) ?></div>
        <?php endif; ?>
      </div>

      <div class="mb-3">
        <label for="arrivalDate" class="form-label">Date</label>
        <input type="date" class="form-control" id="arrivalDate" name="arrival_date"
               value="<?= htmlspecialchars((string)($trip['arrival_date'] ?? '')) ?>" required>
        <?php if (!empty($errors['arrival_date'])): ?>
          <div class="text-danger mt-1"><?= htmlspecialchars($errors['arrival_date']) ?></div>
        <?php endif; ?>
      </div>

      <div class="mb-3">
        <label for="arrivalTime" class="form-label">Heure</label>
        <input type="time" class="form-control" id="arrivalTime" name="arrival_time"
               value="<?= htmlspecialchars((string)($trip['arrival_time'] ?? '')) ?>" required>
        <?php if (!empty($errors['arrival_time'])): ?>
          <div class="text-danger mt-1"><?= htmlspecialchars($errors['arrival_time']) ?></div>
        <?php endif; ?>
      </div>
    </div>

  </div>

  <div class="row mt-3">
    <div class="col-md-6 mx-auto">
      <label for="availableSeats" class="form-label">Nombre de places disponibles</label>
      <input type="number" class="form-control" id="availableSeats" name="available_seats"
             min="1" max="50"
             value="<?= htmlspecialchars((string)($trip['available_seats'] ?? '')) ?>"
             required>
      <?php if (!empty($errors['available_seats'])): ?>
        <div class="text-danger mt-1"><?= htmlspecialchars($errors['available_seats']) ?></div>
      <?php endif; ?>
    </div>
  </div>

  <div class="row mt-4">
    <div class="col text-center">
      <button type="submit" class="btn btn-primary px-4">
        <?= htmlspecialchars($submitLabel ?? 'Enregistrer') ?>
      </button>
    </div>
  </div>
</form>