<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OffreEtServiceRequest;
use App\Http\Requests\OffreEtServiceUpdateRequest;
use App\Models\OffreEtService;
use Illuminate\Support\Facades\Storage;

class OffreEtServiceController extends Controller
{
    // Lister toutes les offres/services
    public function index()

    {
        // Je récupere toutes les offres ou services qui sont présentes dans ma bd et les renvoie en JSON
        return response()->json([
            'success' => true,
            'data' => OffreEtService::all()
            ], 200);
    }




    // Ajouter une offre/service
    public function store(OffreEtServiceRequest $request)

    {
        $validated = $request->validated();

        // Je récupére l'id de l’entreprise depuis l’utilisateur connecté
        $validated['identreprise'] = $request->user()->id;

        // Gestion des fichiers 
            // le fichier pdf
            if ($request->hasfile('pdf_path')){
                $validated['pdf_path'] = $request->file('pdf_path')->store('offres/pdf', 'public');
                }
            
            // l'image
            if ($request->hasfile('photo_path')){
                $validated['photo_path'] = $request->file('photo_path')->store('offres/images', 'public');
                }

        // Je crée l'offre et l'envoie sous format JSON
        $offre = OffreEtService::create($validated);
        
        return response()->json([
            'success' => true,
            'message' => 'Offre créée avec succès',    
            'data' => $offre
        ], 201);
    }




    // Lister une offre/service à partir de son id
    public function show(string $id)
    {
        // A cause de la relation defini dans le model, je demande à Laravel de charger aussi les infos de l'entreprise liée en une seule requête.
        $offre = OffreEtService::with('entreprise')->findOrFail($id);

        // NB : findOrFail gère le 404 déja donc plus besoin de gérer si l'offre n'est pas trouvé moi mm

        return response()->json([
            'success'=> true,
            'data'=> $offre
        ], 200);
    }




    // Modifier une offre/service à partir de son id
    public function update(OffreEtServiceUpdateRequest $request, string $id)
    {
        // Je récupère l'offre que je vx modifier via son id
        $offre = OffreEtService::findOrFail($id);
        
        // Seule l'entreprise propriétaire peut modifier
        if ($offre->identreprise !== $request->user()->id) {
            return response()->json([
                'success' => false,
                'message' => 'Action non autorisée'
            ], 403);
        }
    
        $validated = $request->validated();

        // Je récupére l'id de l’entreprise depuis l’utilisateur connecté (donc depuis le token)
        $validated['identreprise'] = $request->user()->id;

        // Gestion des fichiers 
            // le fichier pdf
            if ($request->hasfile('pdf_path')){
                $validated['pdf_path'] = $request->file('pdf_path')->store('offres/pdf', 'public');
                }
            
            // l'image
            if ($request->hasfile('photo_path')){
                $validated['photo_path'] = $request->file('photo_path')->store('offres/images', 'public');
                }

        // Je valide mes modifs
        $offre->update($validated);
        
        return response()->json([
            'success'=> true,
            'message'=> 'Offre modifiée avec succès',
            'data'=> $offre
        ], 200);
    }




    // Supprimer une offre/service à partir de son id
    public function destroy(string $id)
    {
        $offre = OffreEtService::findOrFail($id);

        // Supprimer le fichier PDF s'il existe
        if ($offre->pdf_path) {
            Storage::disk('public')->delete($offre->pdf_path);
        }

        // Supprimer la photo s'il y en a une
        if ($offre->photo_path) {
            Storage::disk('public')->delete($offre->photo_path);
        }

        $offre->delete();
        return response()->json([
            'success'=> true,
            'message' => 'Offre supprimée avec succès'
            ], 200);
    }

}
