<form class="container mt-4">

  <div class="row">

    <!-- Colonne gauche : Départ -->
    <div class="col-md-6">

      <h4 class="mb-3">Départ</h4>

      <div class="mb-3">
        <label for="InputCity1" class="form-label">Agence</label>
        <select class="form-select" id="InputCity1">
          <option value="">Sélectionnez une agence</option>
          <option value="paris">Paris</option>
          <option value="lyon">Lyon</option>
          <option value="marseille">Marseille</option>
        </select>
      </div>

      <div class="mb-3">
        <label for="InputDate1" class="form-label">Date</label>
        <input type="date" class="form-control" id="InputDate1">
      </div>

      <div class="mb-3">
        <label for="InputTime1" class="form-label">Heure</label>
        <input type="time" class="form-control" id="InputTime1">
      </div>

    </div>

    <!-- Colonne droite : Arrivée -->
    <div class="col-md-6">

      <h4 class="mb-3">Arrivée</h4>

      <div class="mb-3">
        <label for="InputCity2" class="form-label">Agence</label>
        <select class="form-select" id="InputCity2">
          <option value="">Sélectionnez une agence</option>
          <option value="paris">Paris</option>
          <option value="lyon">Lyon</option>
          <option value="marseille">Marseille</option>
        </select>
      </div>

      <div class="mb-3">
        <label for="InputDate2" class="form-label">Date</label>
        <input type="date" class="form-control" id="InputDate2">
      </div>

      <div class="mb-3">
        <label for="InputTime2" class="form-label">Heure</label>
        <input type="time" class="form-control" id="InputTime2">
      </div>

    </div>

  </div>

  <!-- Nombre de places -->
  <div class="row mt-3">
    <div class="col-md-6 mx-auto">
      <label for="InputSeats" class="form-label">Nombre de places disponibles</label>
      <input type="number" class="form-control" id="InputSeats" min="1" max="5">
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