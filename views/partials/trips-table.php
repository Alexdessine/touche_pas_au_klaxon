<?php
$isLoggedIn = isset($_SESSION['user']);
$isAdmin = $isLoggedIn && (($_SESSION['user']['role'] ?? '') === 'admin');
$currentUserId = $isLoggedIn ? (int)($_SESSION['user']['id'] ?? 0) : 0;
?>

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
            <?php if ($isLoggedIn): ?>
                <th class="text-white"></th>
            <?php endif; ?>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($trips as $trip): ?>
            <?php
                $tripId = $trip->getId();
                $ownerId = $trip->getUserId();
                $isOwner = $isLoggedIn && ($ownerId === $currentUserId);

                $canEdit = $isOwner;
                $canManage = $isAdmin || $isOwner;

                $depAgencyId = $trip->getDepartureAgencyId();
                $arrAgencyId = $trip->getArrivalAgencyId();

                $depName = $agencyNamesById[$depAgencyId] ?? ('Agence #' . $depAgencyId);
                $arrName = $agencyNamesById[$arrAgencyId] ?? ('Agence #' . $arrAgencyId);

                $depDT = $trip->getDepartureTime();
                $arrDT = $trip->getArrivalTime();
            ?>

            <tr class="text-center">
                <td class="d-none"><?= htmlspecialchars((string)$tripId) ?></td>

                <td><?= htmlspecialchars($depName) ?></td>
                <td>
                    <time datetime="<?= htmlspecialchars($depDT->format('Y-m-d')) ?>">
                        <?= htmlspecialchars($depDT->format('d-m-Y')) ?>
                    </time>
                </td>
                <td>
                    <time datetime="<?= htmlspecialchars($depDT->format('Y-m-d\TH:i')) ?>">
                        <?= htmlspecialchars($depDT->format('H:i')) ?>
                    </time>
                </td>

                <td><?= htmlspecialchars($arrName) ?></td>
                <td>
                    <time datetime="<?= htmlspecialchars($arrDT->format('Y-m-d')) ?>">
                        <?= htmlspecialchars($arrDT->format('d-m-Y')) ?>
                    </time>
                </td>
                <td>
                    <time datetime="<?= htmlspecialchars($arrDT->format('Y-m-d\TH:i')) ?>">
                        <?= htmlspecialchars($arrDT->format('H:i')) ?>
                    </time>
                </td>

                <td><?= htmlspecialchars((string)$trip->getAvailableSeats()) ?></td>

                <?php if ($isLoggedIn): ?>
                    <td>
                        <!-- Voir : tout utilisateur connecté -->
                        <a href="#"
                            data-bs-toggle="modal"
                            data-bs-target="#tripModal<?= (int)$trip->getId() ?>"
                            title="Voir"
                            class="text-decoration-none">
                            <i class="fa-solid fa-eye"></i>
                        </a>

                        <?php if ($canManage): ?>
                            <?php if ($canEdit): ?>
                            <!-- Edit : propriétaire -->
                            <a href="/trajets/<?= htmlspecialchars((string)$tripId) ?>/edit"
                               title="Modifier" class="text-decoration-none">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <?php endif; ?>
    
                            <!-- Delete : admin ou propriétaire -->
                            <form action="/trajets/<?= htmlspecialchars((string)$tripId) ?>/delete" method="POST" class="d-inline">
                                <input type="hidden" name="id" value="<?= htmlspecialchars((string)$tripId) ?>">
                                <button type="submit"
                                        class="btn btn-link p-0 border-0"
                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce trajet ?')"
                                        title="Supprimer">
                                    <i class="fa-solid fa-trash text-danger"></i>
                                </button>
                            </form>
                        <?php endif; ?>
                    </td>
                <?php endif; ?>
            </tr>
            <!-- Modal -->
            <div class="modal fade"
                id="tripModal<?= (int)$trip->getId() ?>"
                data-bs-backdrop="static"
                data-bs-keyboard="false"
                tabindex="-1"
                aria-labelledby="tripModalLabel<?= (int)$trip->getId() ?>"
                aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                <div class="modal-header">
                    <h1 class="modal-title fs-5"
                        id="tripModalLabel<?= (int)$trip->getId() ?>">
                    Trajet pour
                    <?= htmlspecialchars($agencyNamesById[$trip->getDepartureAgencyId()] ?? 'Inconnu') ?>
                    -
                    <?= htmlspecialchars($agencyNamesById[$trip->getArrivalAgencyId()] ?? 'Inconnu') ?>
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <p>Auteur :
                    <span class="fw-bold">
                        <?= htmlspecialchars($userNamesById[$trip->getUserId()] ?? 'Inconnu') ?>
                    </span>
                    </p>

                    <p>Téléphone :
                    <?php $phone = $userPhoneById[$trip->getUserId()] ?? ''; ?>
                    <span class="fw-bold">
                        <?php if ($phone !== ''): ?>
                        <a href="tel:<?= htmlspecialchars($phone) ?>" class="text-decoration-none">
                            <?= htmlspecialchars($phone) ?>
                        </a>
                        <?php else: ?>
                        <?= htmlspecialchars('') ?>
                        <?php endif; ?>
                    </span>
                    </p>

                    <p>Email :
                    <?php $email = $userEmailById[$trip->getUserId()] ?? ''; ?>
                    <span class="fw-bold">
                        <?php if ($email !== ''): ?>
                        <a href="mailto:<?= htmlspecialchars($email) ?>" class="text-decoration-none">
                            <?= htmlspecialchars($email) ?>
                        </a>
                        <?php else: ?>
                        <?= htmlspecialchars('') ?>
                        <?php endif; ?>
                    </span>
                    </p>

                    <p>Nombre total de places :
                    <span class="fw-bold"><?= htmlspecialchars((string)$trip->getAvailableSeats()) ?></span>
                    </p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-body-color" data-bs-dismiss="modal">Fermer</button>
                </div>

                </div>
            </div>
            </div>
        <?php endforeach; ?>
    </tbody>
</table>