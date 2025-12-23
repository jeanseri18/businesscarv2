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
        Schema::table('achat', function (Blueprint $table) {
            // Vérifier et ajouter les champs qui pourraient manquer
            if (!Schema::hasColumn('achat', 'user_id')) {
                $table->unsignedBigInteger('user_id')->nullable()->after('id');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            }
            
            if (!Schema::hasColumn('achat', 'commercial_id')) {
                $table->unsignedBigInteger('commercial_id')->nullable()->after('user_id');
                $table->foreign('commercial_id')->references('id')->on('users')->onDelete('set null');
            }
            
            if (!Schema::hasColumn('achat', 'notes')) {
                $table->text('notes')->nullable()->after('description');
            }
            
            if (!Schema::hasColumn('achat', 'statut')) {
                $table->string('statut', 50)->default('en_attente')->after('notes');
            }
            
            if (!Schema::hasColumn('achat', 'id_produit_service')) {
                $table->unsignedBigInteger('id_produit_service')->nullable()->after('statut');
                $table->foreign('id_produit_service')->references('id')->on('offreetservice')->onDelete('set null');
            }
            
            if (!Schema::hasColumn('achat', 'whatsapp')) {
                $table->string('whatsapp', 20)->nullable()->after('prenom');
            }
            
            if (!Schema::hasColumn('achat', 'lieu_livraison')) {
                $table->string('lieu_livraison', 255)->nullable()->after('description');
            }
            
            if (!Schema::hasColumn('achat', 'date_livraison')) {
                $table->date('date_livraison')->nullable()->after('lieu_livraison');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('achat', function (Blueprint $table) {
            //
        });
    }
};
