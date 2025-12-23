<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
            CREATE VIEW active_subscriptions AS
            SELECT 
                s.*,
                u.name as user_name,
                u.email as user_email,
                u.phone as user_phone,
                u.country as user_country
            FROM subscriptions s
            JOIN users u ON s.user_id = u.id
            WHERE s.payment_status = 'paid' 
                AND s.end_date >= CURDATE()
                AND s.start_date <= CURDATE()
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS active_subscriptions");
    }
};