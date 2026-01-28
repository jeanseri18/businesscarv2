<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ConnexionRequest;
use App\Http\Requests\InscriptionRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    // Inscription
    public function inscription(InscriptionRequest $request)

    {
        $data = $request->validated();
            
        // Je génère un code automatique pour les commerciaux
        if ($request->role === 'commercial' && empty($data['code_commercial'])) {
            $data['code_commercial'] = 'COM-' . strtoupper(uniqid());
        }

        // Je cree mon utilisateur
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'country' => $data['country'],
            'nationality' => $data['nationality'],
            'role' => $data['role'],
            'code_commercial' => $data['code_commercial'] ?? null,
            'password' => Hash::make($data['password']),
            'accept_terms' => true
        ]);

        // Je cree le token
        $token = $user->createToken('auth_token')->plainTextToken;

        // Je retourne la réponse en format JSON
        return response()->json([
            'success' => true,
            'message' => 'Inscription réussie',
            'user' => $user->only(['id', 'name', 'email', 'phone', 'country', 'nationality','role', 'code_commercial']),
            'access_token' => $token,
            'token_type' => 'Bearer',
        ], 201);
        
    }




    // Connexion
    public function connexion(ConnexionRequest $request) {

        // Je récupère mes credentials 
        $credentials = $request->validated();

        $user = User::where('email', $credentials['email'])->first();

        // Je vérifie si mes identifiants son corrects
        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Email ou mot de passe incorrect.'
            ], 401);
        }

        // Je supprime les anciens tokens
        $user->tokens()->delete();

        // Je crée un nouveau token
        $token = $user->createToken('auth_token')->plainTextToken;

        // Je retourne ma reponse
        return response()->json([
            'success' => true,
            'message' => 'Connexion réussie',
            'user' => $user->only(['id', 'name', 'email', 'phone', 'country', 'nationality','role', 'code_commercial']),
            'access_token' => $token,
            'token_type' => 'Bearer',
        ], 200);
    }




    // Deconnexion
    public function deconnexion(Request $request){

        //Je récupère l'utilisateur connecté via laravel/sanctum
        $user = $request->user();

        // Si l'utilisateur récupéré existe et est connecté
        if ($user){
            $user->tokens()->delete();

            return response()->json([
                'success' => true,
                'message' => 'Déconnexion réussie'
            ], 200);
        }

        // Si non
        return response()->json([
            'success' => false,
            'message' => 'Utilisateur non authentifié.'
        ], 401);

    }
}
