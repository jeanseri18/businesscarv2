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
        Schema::create('commission_commercial', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_achat');
            $table->unsignedBigInteger('id_produit');
            $table->unsignedBigInteger('identreprise');
            $table->decimal('montant', 10, 2);
            $table->enum('statut', ['paye', 'annule', 'en_attente'])->default('en_attente');
            $table->timestamps();
            
            $table->foreign('id_achat')->references('id')->on('achat')->onDelete('cascade');
            $table->foreign('id_produit')->references('id')->on('offreetservice')->onDelete('cascade');
            $table->foreign('identreprise')->references('id')->on('users')->onDelete('cascade');
            $table->index('statut');
            $table->index('identreprise');
            $table->index(['id_achat', 'statut']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commission_commercial');
    }
};