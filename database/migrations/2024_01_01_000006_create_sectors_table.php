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
        Schema::create('sectors', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->enum('type', ['primaire', 'secondaire', 'tertiaire', 'premium']);
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->index('type');
            $table->index('is_active');
        });

        // Insertion des secteurs par défaut
        DB::table('sectors')->insert([
            ['name' => 'Agriculture', 'type' => 'primaire', 'description' => 'Activités agricoles et agro-industrielles'],
            ['name' => 'Pêche', 'type' => 'primaire', 'description' => 'Pêche maritime et continentale'],
            ['name' => 'Élevage', 'type' => 'primaire', 'description' => 'Élevage et production animale'],
            ['name' => 'Industrie', 'type' => 'secondaire', 'description' => 'Industrie manufacturière'],
            ['name' => 'Construction', 'type' => 'secondaire', 'description' => 'Bâtiment et travaux publics'],
            ['name' => 'Commerce', 'type' => 'tertiaire', 'description' => 'Commerce de gros et détail'],
            ['name' => 'Services', 'type' => 'tertiaire', 'description' => 'Services aux entreprises et particuliers'],
            ['name' => 'Premium', 'type' => 'premium', 'description' => 'Accès premium multi-secteurs'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sectors');
    }
};