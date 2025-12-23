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
        Schema::create('subscription_forms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subscription_id')->constrained()->onDelete('cascade');
            $table->string('last_name');
            $table->string('first_name');
            $table->string('cni_number', 50)->nullable();
            $table->integer('age')->nullable();
            $table->string('education_level', 100)->nullable();
            $table->string('location')->nullable();
            $table->string('phone', 20);
            $table->string('whatsapp', 20)->nullable();
            $table->string('email');
            $table->string('country', 100);
            $table->string('nationality', 100);
            $table->string('photo_path', 500)->nullable();
            $table->string('cni_photocopy_path', 500)->nullable();
            $table->timestamps();
            
            $table->index('subscription_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_forms');
    }
};