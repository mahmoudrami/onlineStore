<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->unsignedTinyInteger('rating');
            $table->enum('status', ['active', 'not_active'])->default('not_active');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('review_translations', function (Blueprint $table) {
            $table->id();
            $table->string('comment');
            $table->string('locale');
            $table->foreignId('review_id')->constrained('reviews')->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('review_translations');
        Schema::dropIfExists('reviews');
    }
};
