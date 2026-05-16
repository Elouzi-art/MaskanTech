# MaskanTech — Guide d'installation

## Prérequis
- PHP 8.2+
- Composer
- MySQL (ou MariaDB)
- Node.js 18+

---

## 1. Copier les fichiers dans ton projet

Remplace les fichiers suivants dans ton projet Laravel existant par ceux fournis :

```
app/Http/Controllers/Controller.php           ← FIX: AuthorizesRequests
app/Http/Controllers/PropertyController.php
app/Http/Controllers/DashboardController.php
app/Http/Controllers/ProfileController.php
app/Http/Controllers/MessageController.php
app/Http/Controllers/AppointmentController.php
app/Http/Controllers/FavoriteController.php
app/Http/Controllers/ContactController.php
app/Http/Controllers/AdminController.php
app/Http/Controllers/Auth/AuthenticatedSessionController.php
app/Http/Controllers/Auth/RegisteredUserController.php
app/Http/Middleware/RoleMiddleware.php
app/Http/Requests/PropertyRequest.php
app/Http/Requests/AppointmentRequest.php
app/Http/Requests/ProfileUpdateRequest.php
app/Http/Requests/Auth/LoginRequest.php
app/Models/User.php
app/Models/Property.php
app/Models/PropertyImage.php
app/Models/PropertyFeature.php
app/Models/Appointment.php
app/Models/Message.php
app/Models/Contact.php
app/Models/Notification.php
app/Policies/PropertyPolicy.php
app/Providers/AppServiceProvider.php
bootstrap/app.php                              ← FIX: RoleMiddleware alias
bootstrap/providers.php
routes/web.php                                 ← Routes complètes
routes/auth.php
database/migrations/ (tous les fichiers)
database/seeders/DatabaseSeeder.php
resources/views/ (toutes les vues)
.env                                           ← Adapter DB_PASSWORD si besoin
```

---

## 2. Configurer la base de données

Modifier `.env` selon ta config MySQL :

```env
DB_DATABASE=maskan_tech_db
DB_USERNAME=root
DB_PASSWORD=ton_mot_de_passe
```

Créer la base de données :
```sql
CREATE DATABASE maskan_tech_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

---

## 3. Installer les dépendances

```bash
composer install
npm install
```

---

## 4. Générer la clé et les migrations

```bash
php artisan key:generate        # Si tu as un nouveau .env
php artisan migrate:fresh --seed
php artisan storage:link
```

---

## 5. Lancer le projet

Terminal 1 — Serveur PHP :
```bash
php artisan serve
```

Terminal 2 — Assets Vite :
```bash
npm run dev
```

Ouvrir : **http://127.0.0.1:8000**

---

## 6. Comptes de démo (créés par le seeder)

| Email                     | Mot de passe | Rôle          |
|---------------------------|-------------|---------------|
| admin@maskantech.ma       | password    | Administrateur|
| karim@maskantech.ma       | password    | Agent         |
| leila@maskantech.ma       | password    | Agent         |
| client@maskantech.ma      | password    | Locataire     |
| etudiant@maskantech.ma    | password    | Étudiant      |
| proprio@maskantech.ma     | password    | Propriétaire  |

---

## 7. Bugs corrigés dans cette version

| Bug | Fichier corrigé |
|-----|----------------|
| `authorize()` undefined | `Controller.php` — ajout du trait `AuthorizesRequests` |
| Route `profile.destroy` manquante | `routes/web.php` |
| Route `/home` 404 | `routes/web.php` |
| Navbar HTML cassée (MESSAGES englobait DASHBOARD) | `layouts/app.blade.php` |
| Statut connexion statique | `layouts/app.blade.php` — `@auth/@else` |
| Logout redirige toujours vers `/` | `AuthenticatedSessionController.php` |
| `RoleMiddleware` non enregistré | `bootstrap/app.php` |
| `AppointmentRequest` bloquait student et owner | `AppointmentRequest.php` |
| Page d'accueil redirigeait vers /biens | `routes/web.php` — `view('welcome')` |
| Conflits Git dans `profile/edit.blade.php` | `profile/edit.blade.php` — fusion propre |

---

## Structure des rôles

```
admin    → tout voir, tout modifier, gérer les utilisateurs
agent    → publier/modifier ses biens, gérer ses RDV
owner    → publier/modifier ses biens, favoris, RDV
client   → favoris, RDV, messages
student  → favoris, RDV (biens filtrés : student ou all)
```
