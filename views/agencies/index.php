<?php 
// views/admin/dashboard.php
// Ce fichier affiche la page d'accueil de l'administrateur avec les trajets proposés et les actions possibles (voir, éditer, supprimer).
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
        <tr class="text-center">
            <td>Paris</td>
            <td>
                <a href="/agences/edit"><i class="fa-solid fa-pen"></i></a>
                <form action="/agences/delete" method="POST" class="d-inline">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($agency['id']) ?>">
                    <button type="submit" class="btn btn-link p-0 border-0"  onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette agence ?')">
                        <i class="fa-solid fa-trash text-danger"></i>
                    </button>
                </form>

            </td>
        </tr>
        <tr class="text-center">
            <td>Lyon</td>
            <td>
                <a href="/agences/edit"><i class="fa-solid fa-pen"></i></a>
                <form action="/agences/delete" method="POST" class="d-inline">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($agency['id']) ?>">
                    <button type="submit" class="btn btn-link p-0 border-0"  onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette agence ?')">
                        <i class="fa-solid fa-trash text-danger"></i>
                    </button>
                </form>
            </td>
        </tr>
        <tr class="text-center">
            <td>Marseille</td>
            <td>
                <a href="/agences/edit"><i class="fa-solid fa-pen"></i></a>
                <form action="/agences/delete" method="POST" class="d-inline">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($agency['id']) ?>">
                    <button type="submit" class="btn btn-link p-0 border-0"  onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette agence ?')">
                        <i class="fa-solid fa-trash text-danger"></i>
                    </button>
                </form>
            </td>
        </tr>
        <tr class="text-center">
            <td>Toulouse</td>
            <td>
                <a href="/agences/edit"><i class="fa-solid fa-pen"></i></a>
                <form action="/agences/delete" method="POST" class="d-inline">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($agency['id']) ?>">
                    <button type="submit" class="btn btn-link p-0 border-0"  onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette agence ?')">
                        <i class="fa-solid fa-trash text-danger"></i>
                    </button>
                </form>
            </td>
        </tr>
        <tr class="text-center">
            <td>Nice</td>
            <td>
                <a href="/agences/edit"><i class="fa-solid fa-pen"></i></a>
                <form action="/agences/delete" method="POST" class="d-inline">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($agency['id']) ?>">
                    <button type="submit" class="btn btn-link p-0 border-0"  onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette agence ?')">
                        <i class="fa-solid fa-trash text-danger"></i>
                    </button>
                </form>
            </td>
        </tr>
        <tr class="text-center">
            <td>Nantes</td>
            <td>
                <a href="/agences/edit"><i class="fa-solid fa-pen"></i></a>
                <form action="/agences/delete" method="POST" class="d-inline">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($agency['id']) ?>">
                    <button type="submit" class="btn btn-link p-0 border-0"  onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette agence ?')">
                        <i class="fa-solid fa-trash text-danger"></i>
                    </button>
                </form>
            </td>
        </tr>
        <tr class="text-center">
            <td>Strasbourg</td>
            <td>
                <a href="/agences/edit"><i class="fa-solid fa-pen"></i></a>
                <form action="/agences/delete" method="POST" class="d-inline">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($agency['id']) ?>">
                    <button type="submit" class="btn btn-link p-0 border-0"  onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette agence ?')">
                        <i class="fa-solid fa-trash text-danger"></i>
                    </button>
                </form>
            </td>
        </tr>
        <tr class="text-center">
            <td>Montpellier</td>
            <td>
                <a href="/agences/edit"><i class="fa-solid fa-pen"></i></a>
                <form action="/agences/delete" method="POST" class="d-inline">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($agency['id']) ?>">
                    <button type="submit" class="btn btn-link p-0 border-0"  onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette agence ?')">
                        <i class="fa-solid fa-trash text-danger"></i>
                    </button>
                </form>
            </td>
        </tr>
        <tr class="text-center">
            <td>Bordeaux</td>
            <td>
                <a href="/agences/edit"><i class="fa-solid fa-pen"></i></a>
                <form action="/agences/delete" method="POST" class="d-inline">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($agency['id']) ?>">
                    <button type="submit" class="btn btn-link p-0 border-0"  onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette agence ?')">
                        <i class="fa-solid fa-trash text-danger"></i>
                    </button>
                </form>
            </td>
        </tr>
        <tr class="text-center">
            <td>Lille</td>
            <td>
                <a href="/agences/edit"><i class="fa-solid fa-pen"></i></a>
                <form action="/agences/delete" method="POST" class="d-inline">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($agency['id']) ?>">
                    <button type="submit" class="btn btn-link p-0 border-0"  onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette agence ?')">
                        <i class="fa-solid fa-trash text-danger"></i>
                    </button>
                </form>
            </td>
        </tr>
        <tr class="text-center">
            <td>Rennes</td>
            <td>
                <a href="/agences/edit"><i class="fa-solid fa-pen"></i></a>
                <form action="/agences/delete" method="POST" class="d-inline">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($agency['id']) ?>">
                    <button type="submit" class="btn btn-link p-0 border-0"  onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette agence ?')">
                        <i class="fa-solid fa-trash text-danger"></i>
                    </button>
                </form>
            </td>
        </tr>
        <tr class="text-center">
            <td>Reims</td>
            <td>
                <a href="/agences/edit"><i class="fa-solid fa-pen"></i></a>
                <form action="/agences/delete" method="POST" class="d-inline">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($agency['id']) ?>">
                    <button type="submit" class="btn btn-link p-0 border-0"  onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette agence ?')">
                        <i class="fa-solid fa-trash text-danger"></i>
                    </button>
                </form>
            </td>
        </tr>
        <!-- Ajoutez d'autres agences ici -->
    </tbody>
</table>