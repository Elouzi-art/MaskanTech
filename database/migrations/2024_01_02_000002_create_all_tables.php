<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // ── Ajouter les colonnes manquantes à users si elles n'existent pas ──
        // (Le projet original peut avoir une migration users sans phone/address/role)
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'role')) {
                $table->enum('role', ['admin', 'agent', 'owner', 'client', 'student'])
                      ->default('client')
                      ->after('password');
            }
            if (!Schema::hasColumn('users', 'phone')) {
                $table->string('phone', 30)->nullable()->after('role');
            }
            if (!Schema::hasColumn('users', 'address')) {
                $table->string('address')->nullable()->after('phone');
            }
        });

        // ── Images des annonces ──────────────────────────────────────
        Schema::create('property_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained()->cascadeOnDelete();
            $table->string('image_path');
            $table->boolean('is_primary')->default(false);
            $table->unsignedSmallInteger('order')->default(0);
            $table->timestamps();
            $table->index(['property_id', 'is_primary']);
        });

        // ── Équipements / Features ───────────────────────────────────
        Schema::create('features', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('icon')->nullable();
            $table->timestamps();
        });

        // ── Pivot property ↔ feature ─────────────────────────────────
        Schema::create('property_feature', function (Blueprint $table) {
            $table->foreignId('property_id')->constrained()->cascadeOnDelete();
            $table->foreignId('feature_id')->constrained()->cascadeOnDelete();
            $table->primary(['property_id', 'feature_id']);
        });

        // ── Favoris ──────────────────────────────────────────────────
        Schema::create('favorites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('property_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['user_id', 'property_id']);
        });

        // ── Rendez-vous ──────────────────────────────────────────────
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained()->cascadeOnDelete();
            $table->foreignId('client_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('agent_id')->constrained('users')->cascadeOnDelete();
            $table->date('date');
            $table->string('time', 10);
            $table->text('message')->nullable();
            $table->enum('status', ['pending','confirmed','done','cancelled'])->default('pending');
            $table->timestamps();
            $table->index(['agent_id', 'date']);
            $table->index(['client_id', 'date']);
        });

        // ── Messages ─────────────────────────────────────────────────
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sender_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('receiver_id')->constrained('users')->cascadeOnDelete();
            $table->text('body');
            $table->boolean('is_read')->default(false);
            $table->timestamps();
            $table->index(['sender_id', 'receiver_id']);
            $table->index(['receiver_id', 'is_read']);
        });

        // ── Contacts (formulaire public) ─────────────────────────────
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone', 30)->nullable();
            $table->string('subject')->nullable();
            $table->text('message');
            $table->boolean('is_read')->default(false);
            $table->timestamps();
            $table->index('is_read');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contacts');
        Schema::dropIfExists('messages');
        Schema::dropIfExists('appointments');
        Schema::dropIfExists('favorites');
        Schema::dropIfExists('property_feature');
        Schema::dropIfExists('features');
        Schema::dropIfExists('property_images');

        // Retirer les colonnes ajoutées à users
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(array_filter([
                Schema::hasColumn('users', 'role')    ? 'role'    : null,
                Schema::hasColumn('users', 'phone')   ? 'phone'   : null,
                Schema::hasColumn('users', 'address') ? 'address' : null,
            ]));
        });
    }
};
