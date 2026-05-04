<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // l'agent
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->decimal('price', 12, 2);
            $table->decimal('area', 8, 2)->nullable();
            $table->enum('type', ['house', 'apartment', 'land', 'office']);
            $table->unsignedTinyInteger('rooms')->nullable();
            $table->unsignedTinyInteger('bedrooms')->nullable();
            $table->unsignedTinyInteger('bathrooms')->nullable();
            $table->string('address');
            $table->string('city');
            $table->string('postal_code', 10)->nullable();
            $table->year('year_built')->nullable();
            $table->enum('status', ['available', 'sold', 'rented', 'under_construction'])->default('available');
            $table->boolean('is_featured')->default(false);
            $table->unsignedInteger('views_count')->default(0);
            $table->string('video_url')->nullable(); // lien YouTube/Vimeo
            $table->timestamps();

            $table->index(['status', 'type', 'city']);
            $table->index('is_featured');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
