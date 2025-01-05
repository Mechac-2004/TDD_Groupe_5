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
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('etudiant_id')->constrained('etudiants')->onDelete('cascade'); // Clé étrangère vers la table etudiants
            $table->foreignId('ec_id')->constrained('elements_constitutifs')->onDelete('cascade'); // Clé étrangère vers la table elements_constitutifs
            $table->integer('note');
            $table->enum('session', ['normale', 'rattrapage']); // Valeurs possibles pour la session
            $table->date('date_evaluation'); // Date de l'évaluation
            $table->timestamps(); // Champs created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
