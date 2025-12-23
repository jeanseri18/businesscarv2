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
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('code', 2)->nullable();
            $table->string('currency', 3)->nullable();
            $table->string('phone_code', 10)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->index('is_active');
        });

        // Insertion des pays africains principaux
        DB::table('countries')->insert([
            ['name' => 'Côte d\'Ivoire', 'code' => 'CI', 'currency' => 'XOF', 'phone_code' => '+225'],
            ['name' => 'Sénégal', 'code' => 'SN', 'currency' => 'XOF', 'phone_code' => '+221'],
            ['name' => 'Mali', 'code' => 'ML', 'currency' => 'XOF', 'phone_code' => '+223'],
            ['name' => 'Burkina Faso', 'code' => 'BF', 'currency' => 'XOF', 'phone_code' => '+226'],
            ['name' => 'Niger', 'code' => 'NE', 'currency' => 'XOF', 'phone_code' => '+227'],
            ['name' => 'Togo', 'code' => 'TG', 'currency' => 'XOF', 'phone_code' => '+228'],
            ['name' => 'Bénin', 'code' => 'BJ', 'currency' => 'XOF', 'phone_code' => '+229'],
            ['name' => 'Guinée', 'code' => 'GN', 'currency' => 'GNF', 'phone_code' => '+224'],
            ['name' => 'Ghana', 'code' => 'GH', 'currency' => 'GHS', 'phone_code' => '+233'],
            ['name' => 'Nigéria', 'code' => 'NG', 'currency' => 'NGN', 'phone_code' => '+234'],
            ['name' => 'Cameroun', 'code' => 'CM', 'currency' => 'XAF', 'phone_code' => '+237'],
            ['name' => 'Congo', 'code' => 'CG', 'currency' => 'XAF', 'phone_code' => '+242'],
            ['name' => 'RDC', 'code' => 'CD', 'currency' => 'CDF', 'phone_code' => '+243'],
            ['name' => 'Gabon', 'code' => 'GA', 'currency' => 'XAF', 'phone_code' => '+241'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};