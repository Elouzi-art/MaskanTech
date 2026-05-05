<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Étend la colonne role de la table users pour ajouter student et owner.
     * MySQL ne permet pas de modifier directement un ENUM sans ALTER TABLE.
     *
     * Commande : php artisan migrate
     */
    public function up(): void
    {
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin','agent','client','student','owner') NOT NULL DEFAULT 'client'");
    }

    public function down(): void
    {
        // Rétrograder les nouveaux rôles en client avant de réduire l'enum
        DB::table('users')->whereIn('role', ['student', 'owner'])->update(['role' => 'client']);
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin','agent','client') NOT NULL DEFAULT 'client'");
    }
};
