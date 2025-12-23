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
        Schema::create('offreetservice', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['produit', 'service']);
            $table->string('nom');
            $table->decimal('prix', 10, 2);
            $table->unsignedBigInteger('identreprise');
            $table->string('pdf_path')->nullable();
            $table->string('photo_path')->nullable();
            $table->text('detail')->nullable();
            $table->timestamps();
            
            $table->foreign('identreprise')->references('id')->on('users')->onDelete('cascade');
            $table->index('type');
            $table->index('identreprise');
            $table->index(['type', 'identreprise']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offreetservice');
    }
};