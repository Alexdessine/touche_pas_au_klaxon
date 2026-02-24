<?php 
/**
 * Vue pour afficher la liste des agences de transport dans l'administration.
 * Affiche un tableau avec les noms des agences et des actions pour éditer ou supprimer chaque
 */
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: /login');
    exit();
}
?>
<?php require_once __DIR__ . '/../partials/alert.php'; ?>
<h1>Agences</h1>
<p>Liste des agences présentes dans différentes villes.</p>
<a href="/agences/ajouter" class="btn btn-success mb-4">Ajouter une agence</a></button>
<table class="table table-striped">
    <thead>
        <tr class="fond text-center">
            <th class="text-white">Villes</th>
            <th class="text-white"></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($agencies as $agency): ?>
        <tr class="text-center">
            <td><?= htmlspecialchars($agency->getName()) ?></td>
            <td>
                <a href="/agences/<?= $agency->getId() ?>/edit"><i class="fa-solid fa-pen"></i></a>
                <form action="/agences/<?= $agency->getId() ?>/delete" method="POST" class="d-inline">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($agency->getId()) ?>">
                    <button type="submit" class="btn btn-link p-0 border-0"  onclick="return confirm('Êtes-vous sûr de vouloir supprimer l\'agence de <?= htmlspecialchars($agency->getName()) ?> ?')">
                        <i class="fa-solid fa-trash text-danger"></i>
                    </button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>