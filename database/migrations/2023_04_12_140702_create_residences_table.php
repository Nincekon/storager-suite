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
        Schema::create('residences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->nullable();
            $table->foreignId('category_id')->constrained();
            $table->foreignId('character_id')->constrained();
            $table->foreignId('quarter_id')->constrained();
            $table->foreignId('title')->unique();
            $table->unsignedSmallInteger('nb_small_journey');
            $table->unsignedSmallInteger('nb_long_journey');
            $table->unsignedSmallInteger('nb_persons');
            $table->unsignedInteger('price_small_journey');
            $table->unsignedInteger('price_long_journey');
            $table->unsignedInteger('price_caution')->nullable();
            $table->boolean('sold')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('residences');
    }
};
