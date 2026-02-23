<?php use App\Core\Auth; ?>
<nav class="d-flex flex-row justify-content-around align-items-center bg-light">
    <div class="left">
        <ul class="list-style-none list-unstyled d-flex flex-row align-items-center justify-content-center gap-3 mt-3">
            <li><a class="" href="/">Touche Pas au Klaxon</a></li>
        </ul>
    </div>
    <div class="right d-flex flex-row align-items-center justify-content-center gap-3 p-2">
        <?php if (Auth::check()): ?>
            <?php if (Auth::isAdmin()): ?>
        <ul class=" d-flex list-style-none list-unstyled flex-row align-items-center justify-content-center gap-3 mt-3">
            <li class="admin rounded p-2 text-light"><a class="d-flex align-items-center gap-2" href="/utilisateurs">Utilisateurs<span class="badge text-bg-primary rounded-pill"><?= htmlspecialchars((string)($userCount ?? 0)) ?></span></a></li>
            <li class="admin rounded p-2 text-light"><a class="d-flex align-items-center gap-2" href="/agences">Agences<span class="badge text-bg-primary rounded-pill">5</span></a></li>
            <li class="admin rounded p-2 text-light"><a class="d-flex align-items-center gap-2" href="/trajets">Trajets<span class="badge text-bg-primary rounded-pill">8</span></a></li>
        </ul>
        <?php endif; ?>
        <?php if (Auth::isUser()): ?>
        <ul class=" d-flex list-style-none list-unstyled flex-row align-items-center justify-content-center gap-3 mt-3">
            <li class="admin rounded p-2 text-light"><a class="d-flex align-items-center gap-2" href="/trajets/ajouter">Ajouter un trajet</a></li>
        </ul>
        <?php endif; ?>
        <?php
            $u = Auth::user();
            $fullName = $u ? (($u['firstname'] ?? '') . ' ' . ($u['lastname'] ?? '')) : 'utilisateur';
            ?>
            <p class="d-flex align-items-center mt-3">
                Bonjour <?= htmlspecialchars(trim($fullName)) ?>
            </p>

        <a class="d-flex align-items-center " href="/logout"><i class="fa-solid fa-right-from-bracket"></i><span> Déconnexion</span></a>
        <?php else: ?>
        <a class="d-flex align-items-center " href="/login"><i class="fa-solid fa-left-to-bracket"></i><span> Connexion</span></a>
        <?php endif; ?>

    </div>
</nav>