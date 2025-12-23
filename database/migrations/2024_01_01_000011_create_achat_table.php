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
        Schema::create('achat', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->enum('type', ['produit', 'service']);
            $table->string('whatsapp');
            $table->string('code_commercial')->nullable();
            $table->integer('quantite')->default(1);
            $table->text('description')->nullable();
            $table->string('lieu_livraison');
            $table->date('date_livraison');
            $table->enum('statut', ['en_attente', 'confirme', 'livre', 'annule'])->default('en_attente');
            $table->unsignedBigInteger('id_produit_service')->nullable();
            $table->timestamps();
            
            $table->foreign('id_produit_service')->references('id')->on('offreetservice')->onDelete('set null');
            $table->index('type');
            $table->index('statut');
            $table->index('code_commercial');
            $table->index('date_livraison');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('achat');
    }
};