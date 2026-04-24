# 🚀 Guide Laravel & Git - Collaboration Équipe

> **Objectif** : Un workflow simple et efficace pour travailler à plusieurs sur Laravel

---

## 📦 1. Configuration du Terminal (Optionnel)

Pour voir les branches Git dans VS Code :

1. Téléchargez [Zsh pour MSYS2](https://msys2.org)

2. Copiez `usr` et `etc` vers `C:\Program Files\Git`

3. Dans VS Code `settings.json` :

```json
{
    "terminal.integrated.defaultProfile.windows": "Git Bash",

    "terminal.integrated.profiles.windows": {
        "Git Bash": {
            "path": "C:\\Program Files\\Git\\bin\\bash.exe",

            "args": ["-c", "zsh"]
        }
    }
}
```

---

## 🏗️ 2. Installation du Projet

### Créateur (1 fois)

```bash

git init

git add .

git commit -m "Initialisation"

git remote add origin URL_DU_DEPOT

git push -u origin main

```

### Collaborateur (1 fois)

```bash

# 1. Cloner le projet (tout ce qui est dans .gitignore ne sera PAS téléchargé)

git clone URL_DU_DEPOT

cd nom-projet



# 2. Installer les dépendances PHP (vendor est dans .gitignore)

composer install



# 3. Installer les dépendances Node.js (node_modules est dans .gitignore)

npm install



# 4. CRÉER SON PROPRE FICHIER .env

cp .env.example .env



# 5. Générer une clé unique pour son environnement local

php artisan key:generate



# 6. CRÉER le dossier storage (storage/*.key est dans .gitignore)

php artisan storage:link



# 7. Éditer le .env avec SES propres identifiants

# (Ouvrir .env et modifier : DB_DATABASE, DB_USERNAME, DB_PASSWORD)



# 8. Lancer les migrations

php artisan migrate



# 9. Compiler les assets (public/build est dans .gitignore)

npm run build

# ou en développement :

npm run dev

```

> **⚠️ IMPORTANT** : Les dossiers `/vendor`, `/node_modules`, `/storage`, `/public/build` ne sont PAS sur GitHub. Votre collaborateur doit TOUS les recréer localement avec les commandes ci-dessus.

---

## 📋 Checklist Collaborateur (À cocher)

Pour être exactement dans la même configuration que vous :

- [ ] `composer install` → recrée le dossier `vendor/`

- [ ] `npm install` → recrée le dossier `node_modules/`

- [ ] `cp .env.example .env` → crée son `.env` personnel

- [ ] `php artisan key:generate` → génère sa clé unique

- [ ] `php artisan storage:link` → crée le lien `public/storage`

- [ ] `npm run build` → crée le dossier `public/build/`

- [ ] Modifier `.env` avec SA base de données locale

---

## 🔄 3. Workflow Quotidien (À suivre À CHAQUE FOIS)

```bash

# 1. Récupérer les dernières versions

git checkout main

git pull origin main



# 2. Si quelqu'un a ajouté un package :

composer install

npm install



# 3. Si quelqu'un a modifié les migrations :

php artisan migrate



# 4. Créer une branche pour votre tâche

git checkout -b feature-nom-de-la-tache



# 5. Coder, coder, coder...



# 6. Sauvegarder

git add .

git commit -m "Description"



# 7. Envoyer sur GitHub

git push origin feature-nom-de-la-tache



# 8. Sur GitHub : créer une Pull Request

```

---

## ⚠️ 4. Règles d'Or

| À FAIRE ✅                             | À ÉVITER ❌                          |

| -------------------------------------- | ------------------------------------ |

| `composer require` + prévenir l'équipe | Installer un package sans le dire    |

| `npm install` + prévenir l'équipe      | Installer un package JS sans le dire |

| `php artisan make:migration` + push    | Créer des tables dans phpMyAdmin     |

| Chacun son `.env`                      | Modifier `.env.example`              |

| Travailler dans une branche            | Travailler directement sur `main`    |

---

## 🆘 5. Commandes Utiles

```bash

# Voir ce qui est ignoré par .gitignore

git status --ignored



# Vérifier si tout est bien installé

php artisan list

npm list --depth=0



# Recréer tous les dossiers manquants

composer dump-autoload

npm ci  # installation plus propre que npm install

```

---

## 📝 Résumé Visuel

```

CE QUI N'EST PAS SUR GITHUB (dans .gitignore) :

vendor/          → composer install

node_modules/    → npm install

.env             → cp .env.example .env + key:generate

storage/*.key    → artisan storage:link

public/build/    → npm run build



ETAPES COLLABORATEUR :

clone → composer install → npm install → cp .env.example .env

→ key:generate → storage:link → edit .env → migrate → npm run build

```

---

**💡 Astuce** : Si vous avez un doute, comparer `composer.json` et `package.json` avec votre collaborateur. Ces fichiers SONT sur GitHub et définissent ce qu'il faut installer.

**Réponse directe pour votre collaborateur** : Il doit exécuter ces commandes dans l'ordre :

```bash

composer install          # recrée vendor/

npm install              # recrée node_modules/

cp .env.example .env     # crée son .env

php artisan key:generate # génère sa clé

php artisan storage:link # crée storage/

npm run build           # crée public/build/

# puis éditer .env avec SA base de données

php artisan migrate

```

---

# ⚡ TOUTES LES COMMANDES UTILES - Git & Laravel

---

## 📦 GIT - Commandes de base

```bash

# Configuration

git config --global user.name "Ton Nom"

git config --global user.email "ton@email.com"



# Démarrer / Cloner

git init

git clone URL_DU_DEPOT



# Vérifier l'état

git status

git log --oneline --graph

git diff



# Branches

git branch                    # Voir les branches locales

git branch -a                 # Voir toutes les branches (locales + distantes)

git checkout nom-branche      # Changer de branche

git checkout -b nouvelle-branche  # Créer + changer

git branch -d nom-branche     # Supprimer une branche



# Travailler

git add .                     # Ajouter tous les fichiers

git add nom-fichier           # Ajouter un fichier spécifique

git commit -m "Message"       # Commiter

git commit --amend -m "Message"  # Modifier le dernier commit



# Synchroniser

git pull origin main          # Récupérer les dernières modifs

git push origin main          # Envoyer vers GitHub

git push -u origin main       # Premier push (lier la branche)

git push origin --delete nom-branche  # Supprimer une branche distante



# Annuler / Corriger

git restore nom-fichier       # Annuler les modifs (avant add)

git restore --staged nom-fichier  # Retirer du staging (après add)

git reset --hard              # Revenir au dernier commit (perd tout)

git reset --soft HEAD~1       # Annuler le dernier commit (garde les modifs)



# Stash (mettre de côté temporairement)

git stash                     # Sauvegarder les modifs en cours

git stash pop                 # Récupérer les modifs sauvegardées

git stash list                # Voir la liste des stash

git stash drop                # Supprimer le dernier stash

```

---

## 🐘 LARAVEL - Commandes essentielles

```bash

# Installation et dépendances

composer create-project laravel/laravel nom-projet

composer install              # Installer les dépendances PHP

composer require nom-package  # Ajouter un package

composer remove nom-package   # Retirer un package

composer dump-autoload        # Recharger l'autoloading

composer update               # Mettre à jour tous les packages



# Node.js / Assets

npm install                   # Installer dépendances JS

npm install nom-package       # Ajouter un package JS

npm run dev                   # Mode développement (watch)

npm run build                 # Compiler pour production

npm run prod                  # Alias de build



# Configuration

cp .env.example .env          # Créer son .env

php artisan key:generate      # Générer la clé d'application

php artisan config:cache      # Cacher la config

php artisan config:clear      # Effacer le cache config



# Base de données

php artisan migrate           # Lancer les migrations

php artisan migrate:fresh     # Réinitialiser + migrer (perd les données)

php artisan migrate:rollback  # Annuler la dernière migration

php artisan migrate:status    # Voir l'état des migrations

php artisan make:migration nom_de_la_table

php artisan db:seed           # Lancer les seeders

php artisan migrate --seed    # Migrer +Seeder

php artisan make:seeder NomSeeder

php artisan tinker            # Console interactive (DB queries)



# Créer des fichiers

php artisan make:controller NomController

php artisan make:model NomModel

php artisan make:request NomRequest

php artisan make:middleware NomMiddleware

php artisan make:event NomEvent

php artisan make:listener NomListener

php artisan make:job NomJob

php artisan make:mail NomMail

php artisan make:notification NomNotification

php artisan make:policy NomPolicy

php artisan make:rule NomRule

php artisan make:factory NomFactory



# Storage

php artisan storage:link      # Créer le lien symbolique public/storage



# Cache

php artisan cache:clear       # Effacer le cache application

php artisan route:clear       # Effacer le cache des routes

php artisan view:clear        # Effacer le cache des vues

php artisan optimize:clear    # Effacer TOUS les caches



# Utilitaires

php artisan route:list        # Voir toutes les routes

php artisan route:list --name=nom  # Filtrer les routes

php artisan tinker            # Console interactive

php artisan about             # Infos sur l'application

php artisan env               # Afficher l'environnement actuel

```

---

## 🔄 Workflow quotidien (le plus utilisé)

```bash

# === AVANT DE CODER ===

git checkout main

git pull origin main

git checkout -b feature-ma-tache



# === PENDANT LE CODE ===

git add .

git commit -m "Description"

git push origin feature-ma-tache



# === SI NOUVEAU PACKAGE ===

composer require nom-package

# ou

npm install nom-package

# PUIS prévenir l'équipe !



# === APRÈS UN GIT PULL ===

composer install              # Si nouveau package PHP

npm install                   # Si nouveau package JS

php artisan migrate           # Si nouvelle migration

npm run build                 # Si assets modifiés



# === EN CAS DE CONFLIT ===

git pull origin main

# résoudre les conflits dans les fichiers

git add .

git commit -m "Merge résolu"

git push

```

# 🎯 Commandes Git Opti

```bash

# MERGE (fusion)

git checkout main                    # Aller sur la branche qui reçoit la fusion

git merge feature-ma-branche         # Fusionner feature dans main

git merge --no-ff feature-ma-branche # Fusion avec commit explicite

git merge --squash feature-ma-branche # Fusionner en un seul commit

git merge --abort                    # Annuler la fusion (conflits)

git merge --continue                 # Continuer après résolution des conflits



# REBASE

git rebase main                      # Rebaser la branche courante sur main

git rebase --continue                # Continuer après conflit

git rebase --abort                   # Annuler le rebase

git rebase -i HEAD~3                 # Rebase interactif (squash, edit)



# STASH

git stash                            # Sauvegarder les modifs en cours

git stash pop                        # Récupérer et supprimer le stash

git stash list                       # Voir tous les stash

git stash apply                      # Appliquer sans supprimer

git stash drop                       # Supprimer un stash

git stash clear                      # Tout supprimer



# REMOTE

git remote -v                        # Voir les remotes

git remote add origin URL            # Ajouter un remote

git remote remove origin             # Supprimer un remote

git remote show origin               # Infos sur le remote



# TAGS

git tag                              # Lister les tags

git tag v1.0.0                       # Créer un tag

git tag -a v1.0.0 -m "Message"       # Tag annoté

git push origin v1.0.0               # Pousser un tag

git push origin --tags               # Pousser tous les tags

git tag -d v1.0.0                    # Supprimer un tag local



# PULL avec rebase

git pull --rebase origin main        # Pull + Rebase (historique propre)



---



## 📋 Récapitulatif rapide



| Situation                    | Commande                                             |

| ---------------------------- | ---------------------------------------------------- |

| Démarrer un projet           | `composer create-project laravel/laravel .`          |

| Récupérer le projet          | `git clone URL` → `composer install` → `npm install` |

| Créer son .env               | `cp .env.example .env` → `php artisan key:generate`  |

| Lancer le serveur            | `php artisan serve`                                  |

| Créer une migration          | `php artisan make:migration create_nom_table`        |

| Lancer les migrations        | `php artisan migrate`                                |

| Sauvegarder mon code         | `git add .` → `git commit -m "message"` → `git push` |

| Récupérer le code des autres | `git pull`                                           |

| Voir ce qui a changé         | `git status`                                         |

| Annuler mes modifications    | `git restore .`                                      |



---



**💡 ASTUCES** :



- `git log --oneline --graph` = voir l'historique en arbre

- `php artisan route:list` = trouver tous vos URLs

- `php artisan tinker` = tester du code Laravel vite fait

- `composer outdated` = voir les packages à mettre à jour

```
