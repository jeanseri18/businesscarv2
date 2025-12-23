<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CommercialCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Generate code_commercial for commercial users who don't have one
        $commercialUsers = User::where('role', 'commercial')
            ->whereNull('code_commercial')
            ->get();

        foreach ($commercialUsers as $user) {
            $code = 'COMM' . str_pad($user->id, 4, '0', STR_PAD_LEFT);
            $user->update(['code_commercial' => $code]);
        }
    }
}