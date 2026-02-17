#!/usr/bin/env bash
set -euo pipefail

# --- Pré-requis ---
command -v gh >/dev/null 2>&1 || { echo "Erreur: gh n'est pas installé."; exit 1; }

# Vérifie l'auth GitHub
if ! gh auth status >/dev/null 2>&1; then
  echo "Erreur: tu n'es pas connecté à GitHub CLI. Lance: gh auth login"
  exit 1
fi

# Vérifie qu'on est dans un repo avec remote GitHub
if ! gh repo view >/dev/null 2>&1; then
  echo "Erreur: ce dossier ne semble pas être un repo GitHub (ou remote manquant)."
  echo "Vérifie avec: git remote -v"
  exit 1
fi

SEED_DIR=".github/issue-seed"
if [ ! -d "$SEED_DIR" ]; then
  echo "Erreur: dossier introuvable: $SEED_DIR"
  exit 1
fi

# --- Helper ---
create_issue () {
  local title="$1"
  local file="$2"
  local labels="$3"

  if [ ! -f "$file" ]; then
    echo "Erreur: fichier introuvable: $file"
    exit 1
  fi

  echo "Création: $title"
  gh issue create \
    --title "$title" \
    --body-file "$file" \
    --label "$labels" >/dev/null

  echo "OK: $title"
}

# -----------------------
# PHASE 0 — INIT & BDD
# -----------------------

create_issue "Phase 0 — Initialiser l’architecture MVC" \
  "$SEED_DIR/000-architecture-mvc.md" \
  "feature,mvc,phase-0-init"

create_issue "Phase 0 — Implémenter la connexion PDO sécurisée" \
  "$SEED_DIR/001-db-pdo-connection.md" \
  "feature,database,backend,phase-0-init"

create_issue "Phase 0 — Création du schéma SQL et jeu d’essai" \
  "$SEED_DIR/002-db-schema-and-seed.md" \
  "feature,database,phase-0-init"

# -----------------------
# PHASE 1 — AUTH
# -----------------------

create_issue "Phase 1 — Implémenter le formulaire de connexion" \
  "$SEED_DIR/010-auth-login-form.md" \
  "feature,auth,frontend,phase-1-auth"

create_issue "Phase 1 — Implémenter gestion des rôles et permissions" \
  "$SEED_DIR/011-auth-roles-permissions.md" \
  "feature,auth,security,phase-1-auth"

# -----------------------
# PHASE 2 — ACCUEIL
# -----------------------

create_issue "Phase 2 — Affichage des trajets disponibles (tri + filtres)" \
  "$SEED_DIR/020-home-available-trips.md" \
  "feature,backend,frontend,phase-2-home"

# -----------------------
# PHASE 3 — TRAJETS UTILISATEUR
# -----------------------

create_issue "Phase 3 — Création d’un trajet" \
  "$SEED_DIR/030-trip-create.md" \
  "feature,validation,backend,phase-3-user"

create_issue "Phase 3 — Modification d’un trajet (auteur uniquement)" \
  "$SEED_DIR/031-trip-edit-author-only.md" \
  "feature,validation,security,phase-3-user"

create_issue "Phase 3 — Suppression d’un trajet (auteur uniquement)" \
  "$SEED_DIR/032-trip-delete-author-only.md" \
  "feature,security,backend,phase-3-user"

create_issue "Phase 3 — Affichage des détails trajet en modale" \
  "$SEED_DIR/033-trip-details-modal.md" \
  "feature,frontend,phase-3-user"

# -----------------------
# PHASE 4 — ADMIN
# -----------------------

create_issue "Phase 4 — Implémenter le tableau de bord administrateur" \
  "$SEED_DIR/040-admin-dashboard.md" \
  "feature,admin,backend,frontend,phase-4-admin"

create_issue "Phase 4 — CRUD agences (admin uniquement)" \
  "$SEED_DIR/041-admin-agencies-crud.md" \
  "feature,admin,database,backend,validation,phase-4-admin"

create_issue "Phase 4 — Suppression d’un trajet par l’administrateur" \
  "$SEED_DIR/042-admin-trip-delete.md" \
  "feature,admin,security,backend,phase-4-admin"

# -----------------------
# PHASE 5 — QUALITÉ
# -----------------------

create_issue "Phase 5 — Intégrer PHPUnit et écrire les tests d’écriture BDD" \
  "$SEED_DIR/050-quality-phpunit.md" \
  "feature,test,backend,database,phase-5-quality"

create_issue "Phase 5 — Intégrer PHPStan et faire passer l’analyse statique" \
  "$SEED_DIR/051-quality-phpstan.md" \
  "feature,refactor,backend,phase-5-quality"

create_issue "Phase 5 — Ajouter DocBlock sur le code (classes, méthodes, paramètres, retours)" \
  "$SEED_DIR/052-quality-docblock.md" \
  "documentation,backend,phase-5-quality"

# -----------------------
# PHASE 6 — DOCS & LIVRABLES
# -----------------------

create_issue "Phase 6 — Rédiger README.md (installation, lancement, utilisation)" \
  "$SEED_DIR/060-doc-readme.md" \
  "documentation,phase-6-docs"

create_issue "Phase 6 — Produire le MCD (JPG/PNG/PDF)" \
  "$SEED_DIR/061-doc-mcd.md" \
  "documentation,database,phase-6-docs"

create_issue "Phase 6 — Rédiger le MLD au format textuel" \
  "$SEED_DIR/062-doc-mld.md" \
  "documentation,database,phase-6-docs"

create_issue "Phase 6 — Préparer le PDF final de rendu" \
  "$SEED_DIR/063-doc-final-pdf.md" \
  "documentation,phase-6-docs"

echo "Toutes les issues ont été créées."
