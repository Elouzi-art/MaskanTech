<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // ─── property_images ───────────────────────────────────────────────
        Schema::create('property_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained()->cascadeOnDelete();
            $table->string('image_path');
            $table->boolean('is_primary')->default(false);
            $table->unsignedTinyInteger('order_position')->default(0);
            $table->timestamps();
        });

        // ─── property_features ─────────────────────────────────────────────
        Schema::create('property_features', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // piscine, garage, jardin, etc.
            $table->timestamps();
        });

        // ─── pivot property_feature_property ───────────────────────────────
        Schema::create('property_feature_property', function (Blueprint $table) {
            $table->foreignId('property_id')->constrained()->cascadeOnDelete();
            $table->foreignId('property_feature_id')->constrained('property_features')->cascadeOnDelete();
            $table->primary(['property_id', 'property_feature_id']);
        });

        // ─── favorites ─────────────────────────────────────────────────────
        Schema::create('favorites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('property_id')->constrained()->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['user_id', 'property_id']);
        });

        // ─── appointments ──────────────────────────────────────────────────
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained()->cascadeOnDelete();
            $table->foreignId('client_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('agent_id')->constrained('users')->cascadeOnDelete();
            $table->date('date');
            $table->time('time');
            $table->text('message')->nullable();
            $table->enum('status', ['pending', 'confirmed', 'refused', 'completed'])->default('pending');
            $table->timestamps();

            $table->index(['agent_id', 'status']);
            $table->index(['client_id', 'status']);
        });

        // ─── messages ──────────────────────────────────────────────────────
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sender_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('receiver_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('property_id')->nullable()->constrained()->nullOnDelete();
            $table->text('message');
            $table->boolean('is_read')->default(false);
            $table->timestamps();

            $table->index(['receiver_id', 'is_read']);
        });

        // ─── blog_posts ────────────────────────────────────────────────────
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('content');
            $table->string('image')->nullable();
            $table->unsignedInteger('views_count')->default(0);
            $table->timestamps();
        });

        // ─── blog_comments ─────────────────────────────────────────────────
        Schema::create('blog_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->constrained('blog_posts')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->text('content');
            $table->enum('status', ['approved', 'pending'])->default('pending');
            $table->timestamps();
        });

        // ─── contacts ──────────────────────────────────────────────────────
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone', 20)->nullable();
            $table->string('subject');
            $table->text('message');
            $table->boolean('is_read')->default(false);
            $table->timestamps();
        });

        // ─── notifications ─────────────────────────────────────────────────
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('type'); // appointment_confirmed, new_message, etc.
            $table->json('data');
            $table->boolean('is_read')->default(false);
            $table->timestamps();

            $table->index(['user_id', 'is_read']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifications');
        Schema::dropIfExists('contacts');
        Schema::dropIfExists('blog_comments');
        Schema::dropIfExists('blog_posts');
        Schema::dropIfExists('messages');
        Schema::dropIfExists('appointments');
        Schema::dropIfExists('favorites');
        Schema::dropIfExists('property_feature_property');
        Schema::dropIfExists('property_features');
        Schema::dropIfExists('property_images');
    }
};
