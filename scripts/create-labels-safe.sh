#!/usr/bin/env bash
set -euo pipefail

: "${GITHUB_TOKEN:?Missing GITHUB_TOKEN}"
: "${OWNER:?Missing OWNER}"
: "${REPO:?Missing REPO}"

API="https://api.github.com/repos/${OWNER}/${REPO}/labels"
AUTH_HEADER="Authorization: Bearer ${GITHUB_TOKEN}"
ACCEPT_HEADER="Accept: application/vnd.github+json"
VERSION_HEADER="X-GitHub-Api-Version: 2022-11-28"
CONTENT_HEADER="Content-Type: application/json"

json_payload () {
  # IMPORTANT: ensure_ascii=True => JSON 100% ASCII, évite les soucis d'encodage Git Bash/Windows
  python - <<'PY' "$1" "$2" "$3"
import json, sys
name, color, desc = sys.argv[1], sys.argv[2], sys.argv[3]
print(json.dumps({"name": name, "color": color, "description": desc}, ensure_ascii=True))
PY
}

label_exists () {
  local name="$1"
  local code
  code=$(curl -sS -o /dev/null -w "%{http_code}" \
    -H "$AUTH_HEADER" -H "$ACCEPT_HEADER" -H "$VERSION_HEADER" \
    "${API}/${name}")
  [[ "$code" == "200" ]]
}

create_or_update_label () {
  local name="$1"
  local color="$2"
  local desc="$3"
  local payload
  payload="$(json_payload "$name" "$color" "$desc")"

  if label_exists "$name"; then
    echo "UPDATE: $name"
    response=$(curl -sS -w "\n%{http_code}" -X PATCH \
      -H "$AUTH_HEADER" -H "$ACCEPT_HEADER" -H "$VERSION_HEADER" -H "$CONTENT_HEADER" \
      "${API}/${name}" \
      -d "$payload")
    body=$(echo "$response" | sed '$d')
    code=$(echo "$response" | tail -n 1)
    if [[ "$code" != "200" ]]; then
      echo "Erreur ($code) UPDATE label: $name"
      echo "$body"
      exit 1
    fi
  else
    echo "CREATE: $name"
    response=$(curl -sS -w "\n%{http_code}" -X POST \
      -H "$AUTH_HEADER" -H "$ACCEPT_HEADER" -H "$VERSION_HEADER" -H "$CONTENT_HEADER" \
      "$API" \
      -d "$payload")
    body=$(echo "$response" | sed '$d')
    code=$(echo "$response" | tail -n 1)
    if [[ "$code" != "201" ]]; then
      echo "Erreur ($code) CREATE label: $name"
      echo "$body"
      echo "Payload envoyé:"
      echo "$payload"
      exit 1
    fi
  fi
}

# NOTE: descriptions ASCII (pas d’apostrophe typographique, pas de tiret long)
create_or_update_label "feature" "1D76DB" "Nouvelle fonctionnalite"
create_or_update_label "bug" "D73A4A" "Signalement d'un bug"
create_or_update_label "documentation" "0075CA" "Documentation ou mise a jour doc"
create_or_update_label "refactor" "FBCA04" "Refactorisation du code"
create_or_update_label "test" "5319E7" "Ajout ou modification de tests"
create_or_update_label "security" "B60205" "Correction ou amelioration securite"

create_or_update_label "mvc" "0E8A16" "Architecture MVC"
create_or_update_label "database" "006B75" "Base de donnees"
create_or_update_label "frontend" "C5DEF5" "Interface utilisateur"
create_or_update_label "backend" "5319E7" "Logique serveur"
create_or_update_label "auth" "F9D0C4" "Authentification"
create_or_update_label "admin" "E99695" "Fonctionnalites administrateur"
create_or_update_label "validation" "F1E05A" "Validation des entrees"
create_or_update_label "bootstrap" "563D7C" "UI Bootstrap"
create_or_update_label "sass" "CF649A" "Styles Sass"

create_or_update_label "phase-0-init" "BFDADC" "Phase 0 - Initialisation"
create_or_update_label "phase-1-auth" "D4C5F9" "Phase 1 - Authentification"
create_or_update_label "phase-2-home" "C2E0C6" "Phase 2 - Accueil"
create_or_update_label "phase-3-user" "FCE2C0" "Phase 3 - Utilisateur"
create_or_update_label "phase-4-admin" "F9C2C2" "Phase 4 - Administrateur"
create_or_update_label "phase-5-quality" "E1E4E8" "Phase 5 - Qualite et Tests"
create_or_update_label "phase-6-docs" "F0FFF4" "Phase 6 - Documentation et Livrables"

echo "OK: labels crees / mis a jour."
