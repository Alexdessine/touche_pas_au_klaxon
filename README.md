# Touche Pas au Klaxon

Application intranet de covoiturage développée en **PHP 8.3** avec une architecture  **MVC stricte** , base de données  **MySQL** , intégrant des exigences professionnelles de sécurité, qualité et tests automatisés.

## Présentation du projet

**Touche Pas au Klaxon** est une application web interne permettant aux collaborateurs d’une entreprise multi-sites de :

* Consulter les trajets inter-sites disponibles
* Proposer un trajet
* Modifier ou supprimer leurs trajets
* Favoriser le covoiturage et réduire les véhicules sous-occupés

Le projet respecte l’intégralité du cahier des charges fourni dans le brief brief

.

## Architecture technique

### Stack technique

* **PHP 8.3** (strict types)
* **MySQL / MariaDB**
* **Bootstrap 5 + Sass**
* **PDO (requêtes préparées)**
* **PHPUnit 12**
* **PHPStan 2.1 (niveau 6)**
* **GitHub Actions (CI/CD)**

### Architecture MVC

<pre class="overflow-visible! px-0!" data-start="956" data-end="1041"><div class="w-full my-4"><div class=""><div class="relative"><div class="h-full min-h-0 min-w-0"><div class="h-full min-h-0 min-w-0"><div class="border corner-superellipse/1.1 border-token-border-light bg-token-bg-elevated-secondary rounded-3xl"><div class="pointer-events-none absolute inset-x-4 top-12 bottom-4"><div class="pointer-events-none sticky z-40 shrink-0 z-1!"><div class="sticky bg-token-border-light"></div></div></div><div class="pointer-events-none absolute inset-x-px top-6 bottom-6"><div class="sticky z-1!"><div class="bg-token-bg-elevated-secondary sticky"></div></div></div><div class="corner-superellipse/1.1 rounded-3xl bg-token-bg-elevated-secondary"><div class="relative z-0 flex max-w-full"><div id="code-block-viewer" dir="ltr" class="q9tKkq_viewer cm-editor z-10 light:cm-light dark:cm-light flex h-full w-full flex-col items-stretch ͼs ͼ16"><div class="cm-scroller"><div class="cm-content q9tKkq_readonly"><span>src/</span><br/><span> ├── Controllers/</span><br/><span> ├── Models/</span><br/><span> ├── Repositories/</span><br/><span> ├── Core/</span><br/><span> └── Views/</span></div></div></div></div></div></div></div></div><div class=""><div class=""></div></div></div></div></div></pre>

### Models

* `User`
* `Trip`
* `Agency`

### Repositories (SQL uniquement)

* `UserRepository`
* `TripRepository`
* `AgencyRepository`

Aucune logique métier dans les repositories.

### Controllers

* `HomeController`
* `TripController`
* `AuthController`
* `UserController`
* `AgencyController`
* `AdminDashboardController`

Aucune requête SQL dans les controllers.

### Core

* `Router`
* `Auth`
* `Connection`
* `BaseController`
* `View`

Infrastructure centralisée.

## Sécurité

### Authentification

* `password_hash()` pour le stockage
* `password_verify()` pour la connexion
* `session_regenerate_id(true)`
* Stockage minimal en session
* Gestion des rôles `admin` / `user`

### Méthodes disponibles

* `Auth::check()`
* `Auth::user()`
* `Auth::attempt()`
* `Auth::logout()`
* `Auth::isAdmin()`
* `Auth::isUser()`

### Protection globale

* Validation serveur via `filter_input`
* Contrôles métier défensifs
* Requêtes préparées PDO
* Protection XSS (`htmlspecialchars`)
* Contrôles d’accès serveur (403)
* PRG (Post → Redirect → Get)
* Messages d’erreur génériques
* Typage strict : `declare(strict_types=1);`

## Module Trajets (CRUD complet)

### Création

Validations :

* Départ ≠ Arrivée
* Arrivée > Départ
* Places > 0
* Pas de doublon
* Réaffichage erreurs champ par champ
* PRG respecté

### Lecture

* Trajets futurs uniquement
* Places disponibles uniquement
* Tri par date croissante

### Modification

* Vérification propriétaire ou admin
* Revalidation complète
* Exclusion ID pour test de doublon

### Suppression

* Contrôle serveur
* Redirection sécurisée

## Module Agences (Admin)

* CRUD complet
* Accès strict administrateur
* Validation serveur obligatoire

## Module Utilisateurs

* Listing des utilisateurs (hors admin)
* Compteur dynamique
* Protection `requireAdmin()`

## Tests unitaires

Configuration stricte :

* `phpunit.xml`
* `requireCoverageMetadata=true`
* Attributs `#[CoversClass]`
* Mock PDO
* Aucune dépendance réelle à la base

### Tests couverts

#### TripRepository

* `create()`
* `update()`
* `delete()`
* `existsDuplicate()`
* `existsDuplicateExcludingId()`

#### UserRepository

* `findByEmail()`

#### Auth

* `check()`
* `user()`
* `logout()`
* `attempt()` (succès / échec)
* `isAdmin()`
* `isUser()`

Tous les tests passent.

## Analyse statique

* PHPStan 2.1
* Niveau 6 strict
* Typage précis `array<string, mixed>`
* Array shapes compatibles
* Hydratation typée

Résultat :

<pre class="overflow-visible! px-0!" data-start="3547" data-end="3569"><div class="w-full my-4"><div class=""><div class="relative"><div class="h-full min-h-0 min-w-0"><div class="h-full min-h-0 min-w-0"><div class="border corner-superellipse/1.1 border-token-border-light bg-token-bg-elevated-secondary rounded-3xl"><div class="pointer-events-none absolute inset-x-4 top-12 bottom-4"><div class="pointer-events-none sticky z-40 shrink-0 z-1!"><div class="sticky bg-token-border-light"></div></div></div><div class="pointer-events-none absolute inset-x-px top-6 bottom-6"><div class="sticky z-1!"><div class="bg-token-bg-elevated-secondary sticky"></div></div></div><div class="corner-superellipse/1.1 rounded-3xl bg-token-bg-elevated-secondary"><div class="relative z-0 flex max-w-full"><div id="code-block-viewer" dir="ltr" class="q9tKkq_viewer cm-editor z-10 light:cm-light dark:cm-light flex h-full w-full flex-col items-stretch ͼs ͼ16"><div class="cm-scroller"><div class="cm-content q9tKkq_readonly"><span>[OK] No errors</span></div></div></div></div></div></div></div></div><div class=""><div class=""></div></div></div></div></div></pre>

## CI/CD

GitHub Actions :

* Exécution PHPUnit (PHP 8.3)
* Exécution PHPStan
* Cache Composer
* Lancement sur Pull Request
* Déclenchement manuel (`workflow_dispatch`)

## Qualité de code

* DocBlocks complets (phpDocumentor)
* PSR-4
* Code défensif
* Séparation stricte des couches
* Repositories purs SQL
* Mock propre en tests

## Base de données

Le dépôt contient :

* Script de création de la base
* Script d’alimentation (jeu d’essai)

## Comptes de démonstration

### Administrateur

Email :

<pre class="overflow-visible! px-0!" data-start="4109" data-end="4131"><div class="w-full my-4"><div class=""><div class="relative"><div class="h-full min-h-0 min-w-0"><div class="h-full min-h-0 min-w-0"><div class="border corner-superellipse/1.1 border-token-border-light bg-token-bg-elevated-secondary rounded-3xl"><div class="pointer-events-none absolute inset-x-4 top-12 bottom-4"><div class="pointer-events-none sticky z-40 shrink-0 z-1!"><div class="sticky bg-token-border-light"></div></div></div><div class="pointer-events-none absolute inset-x-px top-6 bottom-6"><div class="sticky z-1!"><div class="bg-token-bg-elevated-secondary sticky"></div></div></div><div class="corner-superellipse/1.1 rounded-3xl bg-token-bg-elevated-secondary"><div class="relative z-0 flex max-w-full"><div id="code-block-viewer" dir="ltr" class="q9tKkq_viewer cm-editor z-10 light:cm-light dark:cm-light flex h-full w-full flex-col items-stretch ͼs ͼ16"><div class="cm-scroller"><div class="cm-content q9tKkq_readonly"><span>admin@email.fr</span></div></div></div></div></div></div></div></div><div class=""><div class=""></div></div></div></div></div></pre>

Mot de passe :

<pre class="overflow-visible! px-0!" data-start="4150" data-end="4167"><div class="w-full my-4"><div class=""><div class="relative"><div class="h-full min-h-0 min-w-0"><div class="h-full min-h-0 min-w-0"><div class="border corner-superellipse/1.1 border-token-border-light bg-token-bg-elevated-secondary rounded-3xl"><div class="pointer-events-none absolute inset-x-4 top-12 bottom-4"><div class="pointer-events-none sticky z-40 shrink-0 z-1!"><div class="sticky bg-token-border-light"></div></div></div><div class="pointer-events-none absolute inset-x-px top-6 bottom-6"><div class="sticky z-1!"><div class="bg-token-bg-elevated-secondary sticky"></div></div></div><div class="corner-superellipse/1.1 rounded-3xl bg-token-bg-elevated-secondary"><div class="relative z-0 flex max-w-full"><div id="code-block-viewer" dir="ltr" class="q9tKkq_viewer cm-editor z-10 light:cm-light dark:cm-light flex h-full w-full flex-col items-stretch ͼs ͼ16"><div class="cm-scroller"><div class="cm-content q9tKkq_readonly"><span>Admin1234</span></div></div></div></div></div></div></div></div><div class=""><div class=""></div></div></div></div></div></pre>

### Utilisateur

Email :

<pre class="overflow-visible! px-0!" data-start="4204" data-end="4237"><div class="w-full my-4"><div class=""><div class="relative"><div class="h-full min-h-0 min-w-0"><div class="h-full min-h-0 min-w-0"><div class="border corner-superellipse/1.1 border-token-border-light bg-token-bg-elevated-secondary rounded-3xl"><div class="pointer-events-none absolute inset-x-4 top-12 bottom-4"><div class="pointer-events-none sticky z-40 shrink-0 z-1!"><div class="sticky bg-token-border-light"></div></div></div><div class="pointer-events-none absolute inset-x-px top-6 bottom-6"><div class="sticky z-1!"><div class="bg-token-bg-elevated-secondary sticky"></div></div></div><div class="corner-superellipse/1.1 rounded-3xl bg-token-bg-elevated-secondary"><div class="relative z-0 flex max-w-full"><div id="code-block-viewer" dir="ltr" class="q9tKkq_viewer cm-editor z-10 light:cm-light dark:cm-light flex h-full w-full flex-col items-stretch ͼs ͼ16"><div class="cm-scroller"><div class="cm-content q9tKkq_readonly"><span>alexandre.martin@email.fr</span></div></div></div></div></div></div></div></div><div class=""><div class=""></div></div></div></div></div></pre>

Mot de passe :

<pre class="overflow-visible! px-0!" data-start="4256" data-end="4272"><div class="w-full my-4"><div class=""><div class="relative"><div class="h-full min-h-0 min-w-0"><div class="h-full min-h-0 min-w-0"><div class="border corner-superellipse/1.1 border-token-border-light bg-token-bg-elevated-secondary rounded-3xl"><div class="pointer-events-none absolute inset-x-4 top-12 bottom-4"><div class="pointer-events-none sticky z-40 shrink-0 z-1!"><div class="sticky bg-token-border-light"></div></div></div><div class="pointer-events-none absolute inset-x-px top-6 bottom-6"><div class="sticky z-1!"><div class="bg-token-bg-elevated-secondary sticky"></div></div></div><div class="corner-superellipse/1.1 rounded-3xl bg-token-bg-elevated-secondary"><div class="relative z-0 flex max-w-full"><div id="code-block-viewer" dir="ltr" class="q9tKkq_viewer cm-editor z-10 light:cm-light dark:cm-light flex h-full w-full flex-col items-stretch ͼs ͼ16"><div class="cm-scroller"><div class="cm-content q9tKkq_readonly"><span>password</span></div></div></div></div></div></div></div></div><div class=""><div class=""></div></div></div></div></div></pre>

## Installation locale

### Cloner le projet

<pre class="overflow-visible! px-0!" data-start="4332" data-end="4392"><div class="w-full my-4"><div class=""><div class="relative"><div class="h-full min-h-0 min-w-0"><div class="h-full min-h-0 min-w-0"><div class="border corner-superellipse/1.1 border-token-border-light bg-token-bg-elevated-secondary rounded-3xl"><div class="pointer-events-none absolute inset-x-4 top-12 bottom-4"><div class="pointer-events-none sticky z-40 shrink-0 z-1!"><div class="sticky bg-token-border-light"></div></div></div><div class="pointer-events-none absolute inset-x-px top-6 bottom-6"><div class="sticky z-1!"><div class="bg-token-bg-elevated-secondary sticky"></div></div></div><div class="corner-superellipse/1.1 rounded-3xl bg-token-bg-elevated-secondary"><div class="relative z-0 flex max-w-full"><div id="code-block-viewer" dir="ltr" class="q9tKkq_viewer cm-editor z-10 light:cm-light dark:cm-light flex h-full w-full flex-col items-stretch ͼs ͼ16"><div class="cm-scroller"><div class="cm-content q9tKkq_readonly"><span class="ͼ10">git</span><span> clone <URL_DU_DEPOT></span><br/><span class="ͼ10">cd</span><span> touche-pas-au-klaxon</span></div></div></div></div></div></div></div></div><div class=""><div class=""></div></div></div></div></div></pre>

### Installer les dépendances

<pre class="overflow-visible! px-0!" data-start="4429" data-end="4457"><div class="w-full my-4"><div class=""><div class="relative"><div class="h-full min-h-0 min-w-0"><div class="h-full min-h-0 min-w-0"><div class="border corner-superellipse/1.1 border-token-border-light bg-token-bg-elevated-secondary rounded-3xl"><div class="pointer-events-none absolute inset-x-4 top-12 bottom-4"><div class="pointer-events-none sticky z-40 shrink-0 z-1!"><div class="sticky bg-token-border-light"></div></div></div><div class="pointer-events-none absolute inset-x-px top-6 bottom-6"><div class="sticky z-1!"><div class="bg-token-bg-elevated-secondary sticky"></div></div></div><div class="corner-superellipse/1.1 rounded-3xl bg-token-bg-elevated-secondary"><div class="relative z-0 flex max-w-full"><div id="code-block-viewer" dir="ltr" class="q9tKkq_viewer cm-editor z-10 light:cm-light dark:cm-light flex h-full w-full flex-col items-stretch ͼs ͼ16"><div class="cm-scroller"><div class="cm-content q9tKkq_readonly"><span>composer install</span></div></div></div></div></div></div></div></div><div class=""><div class=""></div></div></div></div></div></pre>

### Configurer la base de données

Créer une base MySQL :

<pre class="overflow-visible! px-0!" data-start="4522" data-end="4556"><div class="w-full my-4"><div class=""><div class="relative"><div class="h-full min-h-0 min-w-0"><div class="h-full min-h-0 min-w-0"><div class="border corner-superellipse/1.1 border-token-border-light bg-token-bg-elevated-secondary rounded-3xl"><div class="pointer-events-none absolute inset-x-4 top-12 bottom-4"><div class="pointer-events-none sticky z-40 shrink-0 z-1!"><div class="sticky bg-token-border-light"></div></div></div><div class="pointer-events-none absolute inset-x-px top-6 bottom-6"><div class="sticky z-1!"><div class="bg-token-bg-elevated-secondary sticky"></div></div></div><div class="corner-superellipse/1.1 rounded-3xl bg-token-bg-elevated-secondary"><div class="relative z-0 flex max-w-full"><div id="code-block-viewer" dir="ltr" class="q9tKkq_viewer cm-editor z-10 light:cm-light dark:cm-light flex h-full w-full flex-col items-stretch ͼs ͼ16"><div class="cm-scroller"><div class="cm-content q9tKkq_readonly"><span class="ͼv">CREATE</span><span> DATABASE klaxon;</span></div></div></div></div></div></div></div></div><div class=""><div class=""></div></div></div></div></div></pre>

Configurer les accès dans :

<pre class="overflow-visible! px-0!" data-start="4587" data-end="4615"><div class="w-full my-4"><div class=""><div class="relative"><div class="h-full min-h-0 min-w-0"><div class="h-full min-h-0 min-w-0"><div class="border corner-superellipse/1.1 border-token-border-light bg-token-bg-elevated-secondary rounded-3xl"><div class="pointer-events-none absolute inset-x-4 top-12 bottom-4"><div class="pointer-events-none sticky z-40 shrink-0 z-1!"><div class="sticky bg-token-border-light"></div></div></div><div class="pointer-events-none absolute inset-x-px top-6 bottom-6"><div class="sticky z-1!"><div class="bg-token-bg-elevated-secondary sticky"></div></div></div><div class="corner-superellipse/1.1 rounded-3xl bg-token-bg-elevated-secondary"><div class="relative z-0 flex max-w-full"><div id="code-block-viewer" dir="ltr" class="q9tKkq_viewer cm-editor z-10 light:cm-light dark:cm-light flex h-full w-full flex-col items-stretch ͼs ͼ16"><div class="cm-scroller"><div class="cm-content q9tKkq_readonly"><span>/config/database.php</span></div></div></div></div></div></div></div></div><div class=""><div class=""></div></div></div></div></div></pre>

### Importer les scripts

<pre class="overflow-visible! px-0!" data-start="4647" data-end="4748"><div class="w-full my-4"><div class=""><div class="relative"><div class="h-full min-h-0 min-w-0"><div class="h-full min-h-0 min-w-0"><div class="border corner-superellipse/1.1 border-token-border-light bg-token-bg-elevated-secondary rounded-3xl"><div class="pointer-events-none absolute inset-x-4 top-12 bottom-4"><div class="pointer-events-none sticky z-40 shrink-0 z-1!"><div class="sticky bg-token-border-light"></div></div></div><div class="pointer-events-none absolute inset-x-px top-6 bottom-6"><div class="sticky z-1!"><div class="bg-token-bg-elevated-secondary sticky"></div></div></div><div class="corner-superellipse/1.1 rounded-3xl bg-token-bg-elevated-secondary"><div class="relative z-0 flex max-w-full"><div id="code-block-viewer" dir="ltr" class="q9tKkq_viewer cm-editor z-10 light:cm-light dark:cm-light flex h-full w-full flex-col items-stretch ͼs ͼ16"><div class="cm-scroller"><div class="cm-content q9tKkq_readonly"><span>mysql </span><span class="ͼ12">-u</span><span> root </span><span class="ͼ12">-p</span><span> tpak < database/schema.sql</span><br/><span>mysql </span><span class="ͼ12">-u</span><span> root </span><span class="ͼ12">-p</span><span> tpak < database/seed.sql</span></div></div></div></div></div></div></div></div><div class=""><div class=""></div></div></div></div></div></pre>

### Lancer le serveur

<pre class="overflow-visible! px-0!" data-start="4777" data-end="4820"><div class="w-full my-4"><div class=""><div class="relative"><div class="h-full min-h-0 min-w-0"><div class="h-full min-h-0 min-w-0"><div class="border corner-superellipse/1.1 border-token-border-light bg-token-bg-elevated-secondary rounded-3xl"><div class="pointer-events-none absolute inset-x-4 top-12 bottom-4"><div class="pointer-events-none sticky z-40 shrink-0 z-1!"><div class="sticky bg-token-border-light"></div></div></div><div class="pointer-events-none absolute inset-x-px top-6 bottom-6"><div class="sticky z-1!"><div class="bg-token-bg-elevated-secondary sticky"></div></div></div><div class="corner-superellipse/1.1 rounded-3xl bg-token-bg-elevated-secondary"><div class="relative z-0 flex max-w-full"><div id="code-block-viewer" dir="ltr" class="q9tKkq_viewer cm-editor z-10 light:cm-light dark:cm-light flex h-full w-full flex-col items-stretch ͼs ͼ16"><div class="cm-scroller"><div class="cm-content q9tKkq_readonly"><span>php </span><span class="ͼ12">-S</span><span> localhost:8000 </span><span class="ͼ12">-t</span><span> public</span></div></div></div></div></div></div></div></div><div class=""><div class=""></div></div></div></div></div></pre>

Accéder à :

<pre class="overflow-visible! px-0!" data-start="4835" data-end="4864"><div class="w-full my-4"><div class=""><div class="relative"><div class="h-full min-h-0 min-w-0"><div class="h-full min-h-0 min-w-0"><div class="border corner-superellipse/1.1 border-token-border-light bg-token-bg-elevated-secondary rounded-3xl"><div class="pointer-events-none absolute inset-x-4 top-12 bottom-4"><div class="pointer-events-none sticky z-40 shrink-0 z-1!"><div class="sticky bg-token-border-light"></div></div></div><div class="pointer-events-none absolute inset-x-px top-6 bottom-6"><div class="sticky z-1!"><div class="bg-token-bg-elevated-secondary sticky"></div></div></div><div class="corner-superellipse/1.1 rounded-3xl bg-token-bg-elevated-secondary"><div class="relative z-0 flex max-w-full"><div id="code-block-viewer" dir="ltr" class="q9tKkq_viewer cm-editor z-10 light:cm-light dark:cm-light flex h-full w-full flex-col items-stretch ͼs ͼ16"><div class="cm-scroller"><div class="cm-content q9tKkq_readonly"><span>http://localhost:8000</span></div></div></div></div></div></div></div></div><div class=""><div class=""></div></div></div></div></div></pre>
