<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;

Route::get('/check-enterprises', function() {
    $enterprises = User::where('role', 'entreprise')->get();
    
    echo "<h1>Available Enterprises:</h1>";
    echo "<ul>";
    foreach ($enterprises as $enterprise) {
        echo "<li>ID: {$enterprise->id} - Name: {$enterprise->name} - Role: {$enterprise->role}</li>";
    }
    echo "</ul>";
    
    echo "<h1>Check User ID 7:</h1>";
    $user = User::find(7);
    if ($user) {
        echo "<p>ID: {$user->id}</p>";
        echo "<p>Role: {$user->role}</p>";
        echo "<p>Name: {$user->name}</p>";
    } else {
        echo "<p>User not found</p>";
    }
});