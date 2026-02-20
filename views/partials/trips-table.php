<table class="table table-striped">
    <thead>
        <tr class="fond text-center">
            <th class="text-white d-none">ID</th>
            <th class="text-white">Départ</th>
            <th class="text-white">Date</th>
            <th class="text-white">Heure</th>
            <th class="text-white">Destination</th>
            <th class="text-white">Date</th>
            <th class="text-white">Heure</th>
            <th class="text-white">Places</th>
            <?php if (isset($_SESSION['user'])): ?>
            <th class="text-white"></th>
            <?php endif; ?>
        </tr>
    </thead>
    <tbody>
        <tr class="text-center">
            <td class="d-none">1</td>
            <td>Paris</td>
            <td><time datetime="2024-07-01">01-07-2024</time></td>
            <td><time datetime="2024-07-01T08:00">08:00</time></td>
            <td>Lyon</td>
            <td><time datetime="2024-07-01">01-07-2024</time></td>
            <td><time datetime="2024-07-01T08:00">08:00</time></td>
            <td>3</td>
            <?php if (isset($_SESSION['user'])): ?>
            <td>
                <a href="#" data-bs-toggle="modal" data-bs-target="#staticBackdrop" ><i class="fa-solid fa-eye"></i></a>
                <?php if (isset($_SESSION['user']) && ($_SESSION['user']['id'] == 1 || $_SESSION['user']['role'] === 'admin')): ?>
                    <?php if ($_SESSION['user']['role'] !== 'admin'): ?>
                    <a href="/trajets/edit"><i class="fa-solid fa-pen"></i></a>
                    <?php endif; ?>
                    <form action="/trajets/delete" method="POST" class="d-inline">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($trip['id']) ?>">
                        <button type="submit" class="btn btn-link p-0 border-0"  onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce trajet ?')">
                            <i class="fa-solid fa-trash text-danger"></i>
                        </button>
                    </form>
                <?php endif; ?>
            </td>
            <?php endif; ?>
        </tr>
        <tr class="text-center">
            <td class="d-none">2</td>
            <td>Lille</td>
            <td><time datetime="2024-07-02">02-07-2024</time></td>
            <td><time datetime="2024-07-02T09:30">09:30</time></td>
            <td>Marseille</td>
            <td><time datetime="2024-07-02">02-07-2024</time></td>
            <td><time datetime="2024-07-02T09:30">09:30</time></td>
            <td>2</td>
            <?php if (isset($_SESSION['user'])): ?>
            <td>
                <?php if (isset($_SESSION['user']) && ($_SESSION['user']['id'] == 2 || $_SESSION['user']['role'] === 'admin')): ?>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fa-solid fa-eye"></i></a>
                    <?php if ($_SESSION['user']['role'] !== 'admin'): ?>
                    <a href="/trajets/edit"><i class="fa-solid fa-pen"></i></a>
                    <?php endif; ?>
                    <form action="/trajets/delete" method="POST" class="d-inline">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($trip['id']) ?>">
                        <button type="submit" class="btn btn-link p-0 border-0"  onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce trajet ?')">
                            <i class="fa-solid fa-trash text-danger"></i>
                        </button>
                    </form>
                <?php endif; ?>
            </td>
            <?php endif; ?>
        </tr>
        <!-- Ajoutez d'autres trajets ici -->
    </tbody>
</table>