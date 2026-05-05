<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ajoute target_audience à la table properties.
     * Modifie aussi le statut pour ne garder que location (available / rented).
     *
     * Commande : php artisan migrate
     */
    public function up(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            // Audience cible de l'annonce : all / student / professional
            $table->enum('target_audience', ['all', 'student', 'professional'])
                  ->default('all')
                  ->after('is_featured');
        });

        // Convertir les anciens statuts "sold" en "available" (location only)
        \DB::table('properties')
            ->where('status', 'sold')
            ->update(['status' => 'available']);
    }

    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn('target_audience');
        });
    }
};
