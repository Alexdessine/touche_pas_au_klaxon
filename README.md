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

├── Controllers/
├── Models/
├── Repositories/
├── Core/
└── Views/

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

[OK] No errors

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

admin@email.fr

Mot de passe :

Admin1234

### Utilisateur

Email :

alexandre.martin@email.fr

Mot de passe :

password

## Installation locale

### Cloner le projet

git clone cd touche-pas-au-klaxon

### Se rendre dans le dossier 

cd touche-pas-au-klaxon/

### Installer les dépendances

composer install

### Configurer la base de données

Créer une base MySQL :

CREATE DATABASE tpak;

Créer un fichier `.env` à la racine du projet si celui-ci n'existe pas :

DB_HOST=127.0.0.1
DB_PORT=3306
DB_NAME=tpak
DB_USER=root
DB_PASS=

### Importer les scripts

mysql -u root -p tpak < database/schema.sql 
mysql -u root -p tpak < database/seed.sql

### Lancer le serveur

php -S localhost:8000 -tpublic

Accéder à :

http://localhost:8000
