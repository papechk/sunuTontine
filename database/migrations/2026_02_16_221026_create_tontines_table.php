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
        Schema::create('tontines', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->decimal('montant_cotisation', 12, 2);
            $table->enum('frequence', ['mensuel', 'hebdo']);
            $table->date('date_debut');
            $table->unsignedBigInteger('gestionnaire_id');
            $table->enum('statut', ['actif', 'inactif'])->default('actif');
            $table->timestamps();

            $table->foreign('gestionnaire_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tontines');
    }
};
