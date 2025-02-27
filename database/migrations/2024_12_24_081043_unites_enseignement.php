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
        Schema::create('unites_enseignement', function (Blueprint $table) {
            $table->id(); 
            $table->string('code')->unique(); // Code unique de l'UE (ex: UE11)
            $table->string('nom'); 
            $table->integer('credits_ects'); 
            $table->integer('semestre'); 
            $table->timestamps(); // Champs created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unites_enseignement');
    }
};
