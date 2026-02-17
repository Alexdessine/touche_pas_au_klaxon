---
name: Nouvelle fonctionnalité
about: Ajouter une nouvelle fonctionnalité au projet
title: "[FEATURE] CRUD agences (admin uniquement)"
labels: feature, admin, database, backend, validation, phase-4-admin
assignees: ''
---

## Objectif

Permettre à l’administrateur de lister, créer, modifier et supprimer des agences (villes), et à lui seul.

---

## Description

Le brief précise que l’administrateur est le seul à pouvoir modifier la liste des agences (villes) et qu’il dispose d’un tableau de bord pour lister et gérer les agences.  
Implémenter un module “Agences” côté admin (MVC), avec un accès protégé par le rôle admin.

Fonctionnalités attendues :
- Liste des agences
- Création agence
- Modification agence
- Suppression agence

Contraintes / cohérence :
- Une agence doit avoir un nom non vide (et idéalement unique)
- Interdire la suppression d’une agence si elle est référencée par des trajets (selon règles choisies : soit blocage, soit suppression impossible via contrainte FK)
- Gérer proprement les erreurs et exceptions (PDO, contraintes, validation)

---

## Tâches à réaliser

- [ ] Analyse du besoin (règles de suppression : blocage si utilisée par un trajet)
- [ ] Concevoir routes admin (GET/POST) pour agences
- [ ] Implémenter AgencyModel (CRUD via PDO préparé)
- [ ] Implémenter AgencyController (actions index/create/edit/delete)
- [ ] Implémenter vues admin Bootstrap (liste + formulaires)
- [ ] Validation serveur (trim, longueur, unicité si applicable)
- [ ] Protection d’accès (admin uniquement)
- [ ] Gestion erreurs (messages utilisateur + logs)
- [ ] Tests unitaires PHPUnit (create/update/delete)
- [ ] DocBlock sur classes/méthodes (Model/Controller)
- [ ] Vérification PHPStan (niveau projet)

---

## Critères d’acceptation

- [ ] Seul un admin peut accéder aux écrans agences
- [ ] CRUD complet fonctionnel (list/create/edit/delete)
- [ ] Requêtes SQL sécurisées (PDO préparé)
- [ ] Validation serveur empêche les valeurs invalides
- [ ] La suppression d’une agence utilisée par un trajet est gérée correctement (bloquée avec message clair, ou contrainte DB qui remonte une erreur gérée)
- [ ] Tests PHPUnit couvrent au minimum les opérations d’écriture BDD liées aux agences
- [ ] Code commenté (DocBlock) et conforme au niveau PHPStan retenu

---

## Références

- Phase du projet concernée : Phase 4 — Admin
- Brief : :contentReference[oaicite:1]{index=1}
