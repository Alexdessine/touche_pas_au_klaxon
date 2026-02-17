---
name: Nouvelle fonctionnalité
about: Ajouter une nouvelle fonctionnalité au projet
title: "[FEATURE] Intégrer PHPStan et faire passer l’analyse statique"
labels: feature, refactor, backend, phase-5-quality
assignees: ''
---

## Objectif

Intégrer PHPStan et corriger le code pour passer l’analyse statique.

---

## Description

Le brief impose une vérification de qualité via PHPStan.  
Mettre en place :
- installation via composer
- configuration (phpstan.neon)
- exécution en CI locale (composer script)
- corrections (types, nullability, retours, propriétés, etc.)

---

## Tâches à réaliser

- [ ] Installer PHPStan (composer require --dev)
- [ ] Ajouter phpstan.neon (paths, level, exclusions minimales)
- [ ] Lancer analyse et lister erreurs
- [ ] Corriger erreurs (types, signatures, propriétés, retours)
- [ ] Ajouter script composer : `composer phpstan`
- [ ] Documenter usage dans README

---

## Critères d’acceptation

- [ ] PHPStan installé et configurable
- [ ] Une commande permet de lancer l’analyse
- [ ] Le code passe au niveau choisi (niveau à préciser dans la config)
- [ ] Pas d’exclusions abusives masquant des problèmes

---

## Références

- Phase : Phase 5 — Qualité
- Brief : :contentReference[oaicite:4]{index=4}
