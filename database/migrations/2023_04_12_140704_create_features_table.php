<?php

use App\Models\Feature;
use App\Models\Residence;
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
        Schema::create('features', function (Blueprint $table) {
            $table->id();
            $table->string('title', 70);
            $table->timestamps();
        });

        Schema::create('feature_residence', function (Blueprint $table){
            $table->foreignIdFor(Residence::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Feature::class)->constrained()->cascadeOnDelete();
            $table->primary('residence_id', 'feature_id');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feature_residence');
        Schema::dropIfExists('features');
    }
};
