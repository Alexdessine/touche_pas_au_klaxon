#!/bin/bash

API="https://api.github.com/repos/$OWNER/$REPO/labels"
AUTH_HEADER="Authorization: Bearer $GITHUB_TOKEN"
ACCEPT_HEADER="Accept: application/vnd.github+json"

create_label () {
  curl -s -X POST $API \
    -H "$AUTH_HEADER" \
    -H "$ACCEPT_HEADER" \
    -d "{
      \"name\": \"$1\",
      \"color\": \"$2\",
      \"description\": \"$3\"
    }"
}

# 🎯 TYPES
create_label "feature" "1D76DB" "Nouvelle fonctionnalité"
create_label "bug" "D73A4A" "Signalement d’un bug"
create_label "documentation" "0075CA" "Documentation ou mise à jour doc"
create_label "refactor" "FBCA04" "Refactorisation du code"
create_label "test" "5319E7" "Ajout ou modification de tests"
create_label "security" "B60205" "Correction ou amélioration sécurité"

# 🏗️ ARCHITECTURE
create_label "mvc" "0E8A16" "Architecture MVC"
create_label "database" "006B75" "Base de données"
create_label "frontend" "C5DEF5" "Interface utilisateur"
create_label "backend" "5319E7" "Logique serveur"
create_label "auth" "F9D0C4" "Authentification"
create_label "admin" "E99695" "Fonctionnalités administrateur"
create_label "validation" "F1E05A" "Validation des entrées"
create_label "bootstrap" "563D7C" "UI Bootstrap"
create_label "sass" "CF649A" "Styles Sass"

# 📌 PHASES
create_label "phase-0-init" "BFDADC" "Phase 0 — Initialisation"
create_label "phase-1-auth" "D4C5F9" "Phase 1 — Authentification"
create_label "phase-2-home" "C2E0C6" "Phase 2 — Accueil"
create_label "phase-3-user" "FCE2C0" "Phase 3 — Utilisateur"
create_label "phase-4-admin" "F9C2C2" "Phase 4 — Administrateur"
create_label "phase-5-quality" "E1E4E8" "Phase 5 — Qualité & Tests"
create_label "phase-6-docs" "F0FFF4" "Phase 6 — Documentation & Livrables"

echo "✅ Création des labels terminée."
