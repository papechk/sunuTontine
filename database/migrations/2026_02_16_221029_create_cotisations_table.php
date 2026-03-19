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
        Schema::create('cotisations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('membre_id');
            $table->decimal('montant', 12, 2);
            $table->date('date_paiement')->nullable();
            $table->enum('statut', ['paye', 'impaye'])->default('impaye');
            $table->decimal('penalite', 12, 2)->default(0);
            $table->timestamps();

            $table->foreign('membre_id')->references('id')->on('membres')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cotisations');
    }
};
