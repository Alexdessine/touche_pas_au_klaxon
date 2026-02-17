---
name: Nouvelle fonctionnalité
about: Ajouter une nouvelle fonctionnalité au projet
title: "[FEATURE] Affichage des trajets disponibles"
labels: feature, backend, frontend, phase-2-home
assignees: ''
---

## Objectif

Afficher uniquement trajets futurs avec places disponibles.

---

## Description

Filtrer :
- date_depart > NOW()
- places_disponibles > 0
- ORDER BY date_depart ASC

---

## Tâches à réaliser

- [ ] Méthode Model
- [ ] Controller
- [ ] Vue Bootstrap
- [ ] Tests

---

## Critères d’acceptation

- [ ] Aucun trajet passé
- [ ] Tri correct
- [ ] Conforme au brief
