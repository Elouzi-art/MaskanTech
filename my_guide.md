# Corrections appliquées — POINT → POINT_fixed

## Fichiers modifiés

### 1. `database/migrations/2024_01_01_000001_create_users_table.php`

- ✅ Les 5 rôles intégrés directement : `admin, agent, client, student, owner`
- ✅ Supprime le besoin de la migration ALTER TABLE séparée

### 2. `database/migrations/2024_01_01_000002_create_properties_table.php`

- ✅ `status` ENUM : `available, rented` uniquement (suppression de `sold` et `under_construction`)
- ✅ `target_audience` ENUM intégré directement : `all, student, professional`
- ✅ Supprime le besoin de la migration ADD COLUMN séparée

### 3. Migrations SUPPRIMÉES (redondantes)

- ❌ `2026_05_05_000001_add_target_audience_to_properties.php` → intégré dans migration 002
- ❌ `2026_05_05_000002_extend_users_role_enum.php` → intégré dans migration 001

### 4. `app/Http/Requests/PropertyRequest.php`

- ✅ `authorize()` : autorise aussi le rôle `owner`
- ✅ Règle `status` : `in:available,rented` (suppression de sold/under_construction)
- ✅ Règle `target_audience` ajoutée : `required|in:all,student,professional`

### 5. `app/Http/Controllers/Auth/RegisteredUserController.php`

- ✅ Validation du champ `role` : `required|in:client,student,owner`
- ✅ Sauvegarde du rôle choisi au moment de l'inscription

### 6. `app/Http/Controllers/DashboardController.php`

- ✅ Import `Favorite` supprimé (ce modèle n'existe pas — c'est une table pivot)
- ✅ Remplacé par `DB::table('favorites')->...->count()`

### 7. `app/Policies/PropertyPolicy.php`

- ✅ `create()` : autorise aussi le rôle `owner`

### 8. `resources/views/auth/register.blade.php`

- ✅ Redesigné en dark design (même style que le reste de l'app)
- ✅ Sélection du rôle avec boutons radio visuels : Locataire / Étudiant / Propriétaire

### 9. `resources/views/auth/login.blade.php`

- ✅ Redesigné en dark design sans composants Breeze génériques

### 10. `resources/views/layouts/guest.blade.php`

- ✅ Layout dark cohérent avec `layouts/app.blade.php`

### 11. `database/seeders/DatabaseSeeder.php`

- ✅ Seeder complet avec données de démo réalistes
- ✅ Tous les rôles représentés
- ✅ Annonces avec audience cible variée

---

## Commandes pour démarrer (fresh install)

```bash
# Dans le dossier du projet
php artisan migrate:fresh --seed
php artisan storage:link
php artisan serve
npm run dev
```

## Comptes de démo

| Email                  | Mot de passe | Rôle         |
| ---------------------- | ------------ | ------------ |
| admin@maskantech.ma    | password     | Admin        |
| karim@maskantech.ma    | password     | Agent        |
| leila@maskantech.ma    | password     | Agent        |
| client@maskantech.ma   | password     | Locataire    |
| etudiant@maskantech.ma | password     | Étudiant     |
| proprio@maskantech.ma  | password     | Propriétaire |

## Logique audience

| Rôle utilisateur | Voit les annonces         |
| ---------------- | ------------------------- |
| admin / agent    | Toutes                    |
| student          | `all` + `student`         |
| client           | `all` + `professional`    |
| owner            | Toutes (peut aussi louer) |
