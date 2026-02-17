---
name: Nouvelle fonctionnalité
about: Ajouter une nouvelle fonctionnalité au projet
title: "[FEATURE] Suppression d’un trajet par l’administrateur"
labels: feature, admin, backend, security, phase-4-admin
assignees: ''
---

## Objectif

Permettre à l’administrateur de supprimer n’importe quel trajet depuis le tableau de bord admin.

---

## Description

Le brief indique que l’administrateur peut :
- lister les trajets
- supprimer un trajet

Implémenter :
- Une page admin listant les trajets (ou un tableau dans le dashboard)
- Un bouton “Supprimer” pour chaque trajet
- Une action POST sécurisée (anti-CSRF recommandé) déclenchant la suppression
- Gestion d’erreurs (trajet introuvable, suppression impossible, etc.)

---

## Tâches à réaliser

- [ ] Ajouter l’écran admin “Liste trajets”
- [ ] Implémenter TripModel::deleteById()
- [ ] Implémenter AdminTripController::index() et ::delete()
- [ ] Ajouter confirmation côté UI (modal/confirm)
- [ ] Mettre en place protection CSRF (token session + vérif)
- [ ] Empêcher l’accès non-admin
- [ ] Tests PHPUnit : suppression d’un trajet (écriture BDD)
- [ ] DocBlock + passage PHPStan

---

## Critères d’acceptation

- [ ] Un admin peut supprimer un trajet quel que soit l’auteur
- [ ] Un utilisateur non-admin ne peut pas accéder à l’action
- [ ] La suppression se fait via POST (pas via GET)
- [ ] Les erreurs sont gérées proprement (message + pas de fuite d’info)
- [ ] Tests PHPUnit valident la suppression

---

## Références

- Phase : Phase 4 — Admin
- Brief : :contentReference[oaicite:2]{index=2}
