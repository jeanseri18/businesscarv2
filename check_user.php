<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';

use App\Models\User;

$user = User::find(7);

if ($user) {
    echo "ID: " . $user->id . "\n";
    echo "Role: " . $user->role . "\n";
    echo "Name: " . $user->name . "\n";
} else {
    echo "User not found\n";
    
    // Check if there are any enterprises
    $enterprises = User::where('role', 'entreprise')->get();
    echo "Available enterprises:\n";
    foreach ($enterprises as $enterprise) {
        echo "ID: " . $enterprise->id . " - Name: " . $enterprise->name . " - Role: " . $enterprise->role . "\n";
    }
}