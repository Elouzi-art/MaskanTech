Tu as raison ! Voici la version **complète avec Fork et Upstream** :

# 🚀 Workflow complet - Début du projet MaskanTech (avec Fork)

---

## 📁 Partie 1 : Toi (Créateur du projet)

```bash
# 1. Créer le projet Laravel
composer create-project laravel/laravel MaskanTech
cd MaskanTech

# 2. Initialiser Git
git init
git add .
git commit -m "🎉 Initialisation du projet Laravel"

# 3. Créer dépôt PUBLIC sur GitHub
# Aller sur github.com > New repository > MaskanTech (PUBLIC)

# 4. Lier et pusher
git remote add origin https://github.com/ton-compte/MaskanTech.git
git branch -M main
git push -u origin main
```

---

## 📁 Partie 2 : Elle (Rejoint le projet avec FORK)

```bash
# 1. Aller sur GitHub et FORK ton dépôt
# https://github.com/ton-compte/MaskanTech > bouton FORK (en haut à droite)
# Maintenant elle a son propre copie : https://github.com/son-compte/MaskanTech

# 2. Ouvrir PowerShell dans son dossier
cd C:/Users/Elle/Documents/MaskanTech

# 3. Cloner SON fork (pas le tien)
git clone https://github.com/son-compte/MaskanTech.git
cd MaskanTech

# 4. Ajouter TON dépôt comme UPSTREAM (pour recevoir tes mises à jour)
git remote add upstream https://github.com/ton-compte/MaskanTech.git

# 5. Vérifier ses remotes
git remote -v
# origin   https://github.com/son-compte/MaskanTech.git (fetch/push)
# upstream https://github.com/ton-compte/MaskanTech.git (fetch)

# 6. Installer Laravel
composer install
cp .env.example .env
php artisan key:generate
# Éditer .env pour la DB
php artisan migrate
```

---

## 🔄 Partie 3 : Elle - Workflow quotidien (avec upstream)

```bash
# === CHAQUE MATIN : Récupérer TES nouveautés (depuis upstream) ===
git checkout main
git fetch upstream
git merge upstream/main

# OU en une ligne :
git pull upstream main

# === Envoyer ses mises à jour vers SON fork ===
git push origin main

# === CRÉER SA BRANCHE POUR TRAVAILLER ===
git checkout -b feature-nom-de-sa-tache

# === ELLE CODE, CODE, CODE... ===

# === SAUVEGARDER SON TRAVAIL ===
git add .
git commit -m "Description de ce qu'elle a fait"

# === ENVOYER SA BRANCHE SUR SON FORK ===
git push origin feature-nom-de-sa-tache

# === SUR GITHUB : Elle crée une Pull Request DEPUIS SON FORK vers TON DEPOT ===
# GitHub va automatiquement lui proposer "Compare & pull request"
```

---

## 🔄 Partie 4 : Toi - Tu récupères son travail

```bash
# === VOIR SA PULL REQUEST SUR GITHUB ===
# Dans ton dépôt, onglet "Pull Requests"

# === TESTER SA BRANCHE ===
git fetch origin
git checkout -b feature-nom-de-sa-tache origin/feature-nom-de-sa-tache

# === MERGER SA PULL REQUEST ===
# Sur GitHub : cliquer sur "Merge pull request"
```

---

## 🔄 Partie 5 : Elle - Après que tu aies mergé (mettre à jour son fork)

```bash
# === RÉCUPÉRER TES NOUVEAUX COMMITS (depuis upstream) ===
git checkout main
git pull upstream main

# === METTRE À JOUR SON FORK ===
git push origin main

# === SUPPRIMER SA BRANCHE (optionnel) ===
git branch -d feature-nom-de-sa-tache
git push origin --delete feature-nom-de-sa-tache
```

---

## 📋 Schéma visuel des flux

```
                    TON DEPOT (original)
                    github.com/toi/MaskanTech
                           ▲
                           │ Pull Request
                           │
                    SON FORK (sa copie)
                    github.com/elle/MaskanTech
                           ▲
                           │ git push origin
                           │
                    SON PC (local)
                    C:/elle/MaskanTech
                           ▲
                           │ git pull upstream
                           │ (tes modifications)
                    TON DEPOT (original)
                    github.com/toi/MaskanTech
```

---

## 📋 Récapitulatif des commandes pour ELLE

```bash
# ---- 1 SEULE FOIS (installation) ----
# Sur GitHub : Fork ton dépôt
cd C:/Users/Elle/Documents/MaskanTech
git clone https://github.com/son-compte/MaskanTech.git
cd MaskanTech
git remote add upstream https://github.com/ton-compte/MaskanTech.git
composer install
cp .env.example .env
php artisan key:generate
# Éditer .env pour la DB
php artisan migrate

# ---- CHAQUE MATIN (récupérer tes modifs) ----
git checkout main
git pull upstream main
git push origin main

# ---- CRÉER UNE BRANCHE ET TRAVAILLER ----
git checkout -b feature-ma-tache
# ... coder ...
git add .
git commit -m "ma fonctionnalité"
git push origin feature-ma-tache

# ---- SUR GITHUB : Créer une Pull Request vers TON dépôt ----

# ---- APRÈS QUE TU AIES MERGÉ SA PR ----
git checkout main
git pull upstream main
git push origin main
```

---

## ✅ Comparaison des méthodes

| Méthode                  | Avantages                                                                   | Inconvénients                                    |
| ------------------------ | --------------------------------------------------------------------------- | ------------------------------------------------ |
| **Fork + Upstream**      | Elle a sa propre copie sur GitHub Idéal pour open source Plus professionnel | Plus d'étapes au début                           |
| **Collaborateur direct** | Plus simple Plus rapide                                                     | Elle ne voit pas le projet sur son compte GitHub |

```

**Résumé pour elle** :
1. **Fork** ton dépôt (1 clic sur GitHub)
2. **Clone** son fork
3. **Ajoute upstream** = ton dépôt
4. **Pull upstream** chaque matin pour avoir tes modifs
5. **Push origin** pour envoyer vers son fork
6. **Pull Request** pour te proposer ses changements
```
