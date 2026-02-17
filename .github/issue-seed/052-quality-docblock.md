---
name: Documentation
about: Création ou mise à jour de documentation
title: "[DOC] Ajouter DocBlock sur le code (classes, méthodes, paramètres, retours)"
labels: documentation, backend, phase-5-quality
assignees: ''
---

## Objectif

Documenter le code avec DocBlock pour faciliter la reprise par d’autres développeurs.

---

## Emplacement concerné

- Commentaires de code
- (Éventuellement) dossier docs/

---

## Description

Le brief demande :
- du code commenté avec DocBlock

Couvrir en priorité :
- Database/connexion PDO
- Models (Agencies/Trips/Users)
- Controllers (Auth, Trip, Admin)
- Services/Helpers (validation, CSRF, etc.)

---

## Critères d’acceptation

- [ ] DocBlock présent sur toutes les classes principales
- [ ] DocBlock sur méthodes publiques (params, return, throws)
- [ ] Commentaires à jour et utiles (pas de bruit)
- [ ] Cohérent avec le code actuel

---

## Références

- Phase : Phase 5 — Qualité
- Brief : :contentReference[oaicite:5]{index=5}
