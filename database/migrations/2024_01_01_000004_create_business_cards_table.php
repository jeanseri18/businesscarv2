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
        Schema::create('business_cards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('subscription_id')->constrained()->onDelete('cascade');
            $table->string('card_number', 50)->unique();
            $table->text('qr_code')->nullable();
            $table->enum('status', ['active', 'inactive', 'expired'])->default('active');
            $table->timestamp('generated_at')->useCurrent();
            $table->timestamps();
            
            $table->index('user_id');
            $table->index('card_number');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('business_cards');
    }
};