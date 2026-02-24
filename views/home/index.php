<h1 class="border-bottom border-primary border-2 pb-2 mb-4">
    Bienvenue sur notre site intranet de covoiturage !
</h1>

<p>
    Découvrez notre plateforme de covoiturage pour les trajets interurbains. Inscrivez-vous dès maintenant pour trouver des trajets, partager vos trajets ou simplement explorer les options de covoiturage disponibles.
</p>
<?php if(!isset($_SESSION['user'])): ?>
<h2 class="mt-5">Trajets disponibles</h2>
<p class="mb-4">Pour obtenir plus d'informations sur un trajet, veuillez vous connecter ou vous inscrire.</p>
<?php endif; ?>
<?php require_once __DIR__ . '/../partials/alert.php'; ?>
<?php require_once __DIR__ . '/../partials/trips-table.php'; ?>
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Trajet pour Paris - Lyon</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Auteur : <span class="fw-bold">Alexandre Bourlier</span></p>
        <p>Téléphone : <span class="fw-bold"><a href="tel:+33600000000" class="text-decoration-none">06.00.00.00.00</a></span></p>
        <p>Email : <span class="fw-bold"><a href="mailto:alexandre.bourlier@example.com" class="text-decoration-none">alexandre.bourlier@example.com</a></span></p>
        <p>Nombre total de places : <span>3</span></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-body-color" data-bs-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>