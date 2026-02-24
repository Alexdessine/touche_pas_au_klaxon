<h2>Utilisateurs</h2>
<p>Liste des utilisateurs de l'application.</p>
<table class="table table-striped">
    <thead>
        <tr class="fond text-center">
            <th class="text-white">Nom</th>
            <th class="text-white">Téléphone</th>
            <th class="text-white">Email</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
        <tr class="text-center">
            <td><?= htmlspecialchars($user->getFirstname() . ' ' . $user->getLastname()) ?></td>
            <td><?= htmlspecialchars($user->getPhone()) ?></td>
            <td><?= htmlspecialchars($user->getEmail()) ?></td>
        </tr>
        <?php endforeach; ?>
        <!-- Ajoutez d'autres utilisateurs ici -->
    </tbody>
</table>