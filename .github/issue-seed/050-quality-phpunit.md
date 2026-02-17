---
name: Nouvelle fonctionnalité
about: Ajouter une nouvelle fonctionnalité au projet
title: "[FEATURE] Intégrer PHPUnit et écrire les tests d’écriture BDD"
labels: feature, test, backend, database, phase-5-quality
assignees: ''
---

## Objectif

Mettre en place PHPUnit et couvrir au minimum les fonctionnalités qui écrivent dans la base de données.

---

## Description

Le brief impose l’intégration de tests unitaires (PHPUnit) couvrant au minimum les opérations d’écriture en base :
- création / modification / suppression de trajets (selon ce qui est implémenté)
- CRUD agences (admin)

Mettre en place :
- configuration PHPUnit
- base de test (ou transaction rollback) + fixtures
- exécution via commande (composer script recommandé)

---

## Tâches à réaliser

- [ ] Installer PHPUnit (composer require --dev)
- [ ] Créer phpunit.xml
- [ ] Structurer /tests (unit/integration selon choix)
- [ ] Préparer une base de test + script SQL/fixtures
- [ ] Tests : AgencyModel (create/update/delete)
- [ ] Tests : TripModel (create/update/delete)
- [ ] Isoler tests (transactions/rollback ou reset BDD)
- [ ] Ajouter script composer : `composer test`
- [ ] Documenter l’exécution des tests dans README

---

## Critères d’acceptation

- [ ] PHPUnit s’exécute en une commande
- [ ] Les tests couvrent au minimum toutes les écritures en base exigées
- [ ] Les tests sont isolés (pas d’effet de bord entre tests)
- [ ] Les assertions vérifient le contenu BDD après opération
- [ ] Les tests passent sur un environnement propre

---

## Références

- Phase : Phase 5 — Qualité
- Brief : :contentReference[oaicite:3]{index=3}
