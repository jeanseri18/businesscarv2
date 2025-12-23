<?php

namespace App\Http\Controllers;

use App\Models\OffreEtService;
use App\Models\Subscription;
use App\Models\Achat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EntrepriseController extends Controller
{
  

    public function dashboard()
    {
        $user = Auth::user();
        
        // Statistiques
        $totalOffres = OffreEtService::where('identreprise', $user->id)->count();
        $souscriptionsActives = Subscription::where('user_id', $user->id)->where('payment_status', 'paid')->count();
        
        $revenusTotal = Achat::whereHas('produitService', function($query) use ($user) {
            $query->where('identreprise', $user->id);
        })->where('statut', 'livre')->get()->sum(function($achat) {
            return $achat->quantite * ($achat->produitService->prix ?? 0);
        });
        
        // Dernières offres
        $dernieresOffres = OffreEtService::where('identreprise', $user->id)
            ->latest()
            ->limit(5)
            ->get();
        
        return view('entreprise.dashboard', compact('totalOffres', 'souscriptionsActives', 'revenusTotal', 'dernieresOffres'));
    }

    public function souscriptions()
    {
        $user = Auth::user();
        
        $souscriptions = Subscription::where('user_id', $user->id)
            ->with(['user', 'subscriptionForm', 'enterpriseDocuments', 'businessCards', 'payments'])
            ->latest()
            ->paginate(10);
        
        return view('entreprise.souscriptions', compact('souscriptions'));
    }

    public function detailsSouscription($id)
    {
        $user = Auth::user();
        
        $souscription = Subscription::where('user_id', $user->id)
            ->with(['user', 'subscriptionForm', 'enterpriseDocuments', 'businessCards', 'payments'])
            ->findOrFail($id);
        
        // Récupérer l'historique des statuts si disponible
        $historiqueStatuts = null; // À implémenter selon votre modèle
        
        return view('entreprise.souscriptions.details', compact('souscription', 'historiqueStatuts'));
    }

    public function offres()
    {
        $user = Auth::user();
        
        $offres = OffreEtService::where('identreprise', $user->id)
            ->latest()
            ->paginate(10);
        
        return view('entreprise.offres.index', compact('offres'));
    }

    public function createOffre()
    {
        return view('entreprise.offres.create');
    }

    public function storeOffre(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'detail' => 'required|string',
            'prix' => 'required|numeric|min:0',
            'type' => 'required|in:produit,service',
            'photo_path' => 'nullable|image|max:2048',
            'pdf_path' => 'nullable|file|mimes:pdf|max:10240'
        ]);

        $user = Auth::user();
        
        // Gérer le téléchargement des fichiers
        $photoPath = null;
        $pdfPath = null;
        
        if ($request->hasFile('photo_path')) {
            $photoPath = $request->file('photo_path')->store('offres_photos', 'public');
        }
        
        if ($request->hasFile('pdf_path')) {
            $pdfPath = $request->file('pdf_path')->store('offres_pdfs', 'public');
        }

        OffreEtService::create([
            'identreprise' => $user->id,
            'nom' => $validated['nom'],
            'detail' => $validated['detail'],
            'prix' => $validated['prix'],
            'type' => $validated['type'],
            'photo_path' => $photoPath,
            'pdf_path' => $pdfPath
        ]);

        return redirect()->route('entreprise.offres')->with('success', 'Offre créée avec succès.');
    }

    public function editOffre($id)
    {
        $user = Auth::user();
        
        $offre = OffreEtService::where('identreprise', $user->id)->findOrFail($id);
        
        return view('entreprise.offres.edit', compact('offre'));
    }

    public function updateOffre(Request $request, $id)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'detail' => 'required|string',
            'prix' => 'required|numeric|min:0',
            'type' => 'required|in:produit,service',
            'photo_path' => 'nullable|image|max:2048',
            'pdf_path' => 'nullable|file|mimes:pdf|max:10240'
        ]);

        $user = Auth::user();
        
        $offre = OffreEtService::where('identreprise', $user->id)->findOrFail($id);
        
        // Gérer le téléchargement des nouveaux fichiers
        $photoPath = $offre->photo_path;
        $pdfPath = $offre->pdf_path;
        
        if ($request->hasFile('photo_path')) {
            $photoPath = $request->file('photo_path')->store('offres_photos', 'public');
        }
        
        if ($request->hasFile('pdf_path')) {
            $pdfPath = $request->file('pdf_path')->store('offres_pdfs', 'public');
        }

        $offre->update([
            'nom' => $validated['nom'],
            'detail' => $validated['detail'],
            'prix' => $validated['prix'],
            'type' => $validated['type'],
            'photo_path' => $photoPath,
            'pdf_path' => $pdfPath
        ]);

        return redirect()->route('entreprise.offres')->with('success', 'Offre mise à jour avec succès.');
    }

    public function deleteOffre($id)
    {
        $user = Auth::user();
        
        $offre = OffreEtService::where('identreprise', $user->id)->findOrFail($id);
        
        // Vérifier s'il n'y a pas d'achats associés
        if ($offre->achats()->exists()) {
            return redirect()->route('entreprise.offres')->with('error', 'Cette offre ne peut pas être supprimée car elle a des achats associés.');
        }
        
        $offre->delete();
        
        return redirect()->route('entreprise.offres')->with('success', 'Offre supprimée avec succès.');
    }

    public function editProfile()
    {
        $user = Auth::user();
        return view('entreprise.profile.edit', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'phone' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:100',
            'nationality' => 'nullable|string|max:100',
            'avatar' => 'nullable|image|max:2048',
        ]);

        // Gérer l'upload de l'avatar
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->country = $request->country;
        $user->nationality = $request->nationality;
        $user->save();

        return redirect()->route('entreprise.profile.edit')->with('success', 'Profil mis à jour avec succès.');
    }

    public function editPassword()
    {
        return view('entreprise.profile.password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        // Vérifier le mot de passe actuel
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Le mot de passe actuel est incorrect.']);
        }

        // Mettre à jour le mot de passe
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('entreprise.profile.edit')->with('success', 'Mot de passe mis à jour avec succès.');
    }
}