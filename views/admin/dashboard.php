<h1>
    Bienvenue sur la page d'accueil de Touche Pas au Klaxon !
</h1>
<p>
    Découvrez notre plateforme de covoiturage pour les trajets interurbains. Inscrivez-vous dès maintenant pour trouver des trajets, partager vos trajets ou simplement explorer les options de covoiturage disponibles.
</p>
<h2>Trajets proposés</h2>
<table class="table table-striped">
    <thead>
        <tr class="fond text-center">
            <th class="text-white">Départ</th>
            <th class="text-white">Date</th>
            <th class="text-white">Heure</th>
            <th class="text-white">Destination</th>
            <th class="text-white">Date</th>
            <th class="text-white">Heure</th>
            <th class="text-white">Places</th>
            <th class="text-white"></th>
        </tr>
    </thead>
    <tbody>
        <tr class="text-center">
            <td>Paris</td>
            <td><time datetime="2024-07-01">01-07-2024</time></td>
            <td><time datetime="2024-07-01T08:00">08:00</time></td>
            <td>Lyon</td>
            <td><time datetime="2024-07-01">01-07-2024</time></td>
            <td><time datetime="2024-07-01T08:00">08:00</time></td>
            <td>3</td>
            <td>
                <a href="#" data-bs-toggle="modal" data-bs-target="#staticBackdrop" ><i class="fa-solid fa-eye"></i></a>
                <a href="#"><i class="fa-solid fa-pen"></i></a>
                <a href="#"><i class="fa-solid fa-trash"></i></a>
            </td>
        </tr>
        <tr class="text-center">
            <td>Lille</td>
            <td><time datetime="2024-07-02">02-07-2024</time></td>
            <td><time datetime="2024-07-02T09:30">09:30</time></td>
            <td>Marseille</td>
            <td><time datetime="2024-07-02">02-07-2024</time></td>
            <td><time datetime="2024-07-02T09:30">09:30</time></td>
            <td>2</td>
            <td>
                <a href="#" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fa-solid fa-eye"></i></a>
                <a href="#"><i class="fa-solid fa-pen"></i></a>
                <a href="#"><i class="fa-solid fa-trash"></i></a>
            </td>
        </tr>
        <!-- Ajoutez d'autres trajets ici -->
    </tbody>
</table>

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