<?php
// database/migrations/2024_01_01_000002_create_properties_table.php
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
            // ✅ LOCATION UNIQUEMENT — sold et under_construction retirés
            $table->enum('status', ['available', 'rented'])->default('available');
            $table->boolean('is_featured')->default(false);
            // ✅ target_audience directement dans la migration principale
            $table->enum('target_audience', ['all', 'student', 'professional'])->default('all');
            $table->unsignedInteger('views_count')->default(0);
            $table->string('video_url')->nullable();
            $table->timestamps();

            $table->index(['status', 'type', 'city']);
            $table->index('is_featured');
            $table->index('target_audience');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
