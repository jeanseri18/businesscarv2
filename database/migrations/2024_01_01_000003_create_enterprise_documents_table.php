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
        Schema::create('enterprise_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subscription_id')->constrained()->onDelete('cascade');
            $table->enum('document_type', ['rccm', 'dfe', 'bail', 'rib']);
            $table->string('file_path', 500);
            $table->string('file_name');
            $table->integer('file_size')->nullable();
            $table->timestamp('uploaded_at')->useCurrent();
            
            $table->index('subscription_id');
            $table->index('document_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enterprise_documents');
    }
};