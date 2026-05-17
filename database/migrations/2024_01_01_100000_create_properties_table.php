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
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('type', ['apartment','studio','room','villa','house','office','land'])->default('apartment');
            $table->enum('status', ['available','rented'])->default('available');
            $table->decimal('price', 10, 2);
            $table->decimal('area', 8, 2)->nullable();
            $table->unsignedTinyInteger('rooms')->nullable();
            $table->unsignedTinyInteger('bedrooms')->nullable();
            $table->unsignedTinyInteger('bathrooms')->nullable();
            $table->year('year_built')->nullable();

            $table->string('address');
            $table->string('city', 100);
            $table->string('neighborhood', 100)->nullable();
            $table->string('postal_code', 20)->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();

            $table->enum('target_audience', ['all','student','family','couple','single'])->default('all');
            $table->string('video_url')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->unsignedBigInteger('views_count')->default(0);

            $table->timestamps();

            $table->index(['status', 'city']);
            $table->index(['type', 'status']);
            $table->index('target_audience');
            $table->index('is_featured');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
