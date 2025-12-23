<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Subscription;
use App\Models\Payment;
use App\Models\Achat;
use App\Models\OffreEtService;
use App\Models\CommissionCommercial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CommercialController extends Controller
{
    

    public function dashboard(Request $request)
    {
        $commercial = Auth::user();
        
        if (!$commercial->isCommercial()) {
            abort(403, 'Accès non autorisé');
        }

        // Période par défaut: ce mois-ci
        $periode = $request->get('periode', 'mois');
        $dateDebut = now();
        
        switch ($periode) {
            case 'semaine':
                $dateDebut = now()->subWeek();
                break;
            case 'mois':
                $dateDebut = now()->startOfMonth();
                break;
            case 'trimestre':
                $dateDebut = now()->startOfQuarter();
                break;
            case 'annee':
                $dateDebut = now()->startOfYear();
                break;
        }

        // Statistiques principales
        $totalVentes = 0;
        if ($commercial->code_commercial) {
            $totalVentes = Achat::where('code_commercial', $commercial->code_commercial)
                ->where('statut', 'confirme')
                ->where('achat.created_at', '>=', $dateDebut)
                ->join('offreetservice', 'achat.id_produit_service', '=', 'offreetservice.id')
                ->selectRaw('SUM(achat.quantite * offreetservice.prix) as total')
                ->value('total') ?? 0;
        }

        $ventesConfirmees = 0;
        $totalConversions = 0;
        if ($commercial->code_commercial) {
            $ventesConfirmees = Achat::where('code_commercial', $commercial->code_commercial)
                ->where('statut', 'confirme')
                ->where('achat.created_at', '>=', $dateDebut)
                ->count();

            $totalConversions = Achat::where('code_commercial', $commercial->code_commercial)
                ->where('statut', 'confirme')
                ->where('achat.created_at', '>=', $dateDebut)
                ->count();
        }

        $totalCommissions = Payment::join('subscriptions', 'payments.subscription_id', '=', 'subscriptions.id')
            ->where('subscriptions.user_id', $commercial->id)
            ->where('payments.status', 'completed')
            ->where('payments.created_at', '>=', $dateDebut)
            ->sum('payments.amount') ?? 0;

        $tauxConversion = 0;
        $totalLeads = Subscription::where('user_id', $commercial->id)
            ->where('subscriptions.created_at', '>=', $dateDebut)
            ->count();
        
        if ($totalLeads > 0) {
            $tauxConversion = round(($totalConversions / $totalLeads) * 100, 2);
        }

        // Données récentes
        $ventesRecentes = collect();
        if ($commercial->code_commercial) {
            $ventesRecentes = Achat::with(['produitService', 'user'])
                ->where('code_commercial', $commercial->code_commercial)
                ->where('achat.created_at', '>=', $dateDebut)
                ->latest()
                ->take(10)
                ->get();
        }

        $commissionsRecentes = Payment::with(['subscription.user'])
            ->join('subscriptions', 'payments.subscription_id', '=', 'subscriptions.id')
            ->where('subscriptions.user_id', $commercial->id)
            ->where('payments.created_at', '>=', $dateDebut)
            ->latest('payments.created_at')
            ->select('payments.*')
            ->take(10)
            ->get();

        // Graphique des ventes par mois
        $ventesParMois = [];
        if ($commercial->code_commercial) {
            $ventesParMois = Achat::where('code_commercial', $commercial->code_commercial)
                ->where('statut', 'confirme')
                ->where('achat.created_at', '>=', now()->subMonths(11))
                ->selectRaw('MONTH(achat.created_at) as mois, SUM(quantite * (SELECT prix FROM offreetservice WHERE offreetservice.id = achat.id_produit_service)) as total')
                ->groupBy('mois')
                ->pluck('total', 'mois')
                ->toArray();
        }

        return view('commerciaux.dashboard', compact(
            'totalVentes', 
            'ventesConfirmees', 
            'totalCommissions', 
            'tauxConversion',
            'ventesRecentes',
            'commissionsRecentes',
            'periode',
            'ventesParMois'
        ));
    }

    public function souscriptions(Request $request)
    {
        $commercial = Auth::user();
        
        if (!$commercial->isCommercial()) {
            abort(403, 'Accès non autorisé');
        }

        $query = Subscription::with(['user', 'payments'])
            ->where('user_id', $commercial->id)
            ->latest();

        // Filtres
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('status')) {
            $query->where('payment_status', $request->status);
        }

        $souscriptions = $query->paginate(10);

        return view('commerciaux.souscriptions', compact('souscriptions'));
    }

    public function ventes(Request $request)
    {
        $commercial = Auth::user();
        
        if (!$commercial->isCommercial()) {
            abort(403, 'Accès non autorisé');
        }

        $query = Achat::with(['produitService', 'user']);
        
        if ($commercial->code_commercial) {
            $query->where('code_commercial', $commercial->code_commercial);
        } else {
            $query->whereRaw('1 = 0'); // Return empty results if no code_commercial
        }
        
        $query->latest();

        // Filtres
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nom', 'like', "%{$search}%")
                  ->orWhere('prenom', 'like', "%{$search}%")
                  ->orWhereHas('produitService', function($q2) use ($search) {
                      $q2->where('nom', 'like', "%{$search}%");
                  });
            });
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('status')) {
            $query->where('statut', $request->status);
        }

        if ($request->filled('date_debut')) {
            $query->whereDate('achat.created_at', '>=', $request->date_debut);
        }

        $ventes = $query->paginate(10);

        return view('commerciaux.ventes', compact('ventes'));
    }

    public function offres(Request $request)
    {
        $commercial = Auth::user();
        
        if (!$commercial->isCommercial()) {
            abort(403, 'Accès non autorisé');
        }

        $query = OffreEtService::latest();

        // Filtres
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nom', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($request->filled('categorie')) {
            $query->where('categorie', $request->categorie);
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $offres = $query->paginate(12);

        return view('commerciaux.offres', compact('offres'));
    }

    public function detailsVente(Achat $vente)
    {
        $commercial = Auth::user();
        
        if (!$commercial->isCommercial() || !$commercial->code_commercial || $vente->code_commercial !== $commercial->code_commercial) {
            abort(403, 'Accès non autorisé');
        }

        $vente->load(['produitService', 'user']);

        return view('commerciaux.details-vente', compact('vente'));
    }

    public function commissions(Request $request)
    {
        $commercial = Auth::user();
        
        if (!$commercial->isCommercial()) {
            abort(403, 'Accès non autorisé');
        }

        $query = CommissionCommercial::with(['user', 'produitService', 'achat'])
            ->where('identreprise', $commercial->id);

        // Recherche
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('user', function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
                })
                ->orWhereHas('produitService', function($q) use ($search) {
                    $q->where('nom', 'like', "%{$search}%");
                });
            });
        }

        // Filtrer par statut
        if ($request->filled('status')) {
            $query->where('statut', $request->status);
        }

        // Filtrer par date
        if ($request->filled('date_debut')) {
            $query->whereDate('commission_commercial.created_at', '>=', $request->date_debut);
        }

        if ($request->filled('date_fin')) {
            $query->whereDate('commission_commercial.created_at', '<=', $request->date_fin);
        }

        $commissions = $query->latest()->paginate(10);

        return view('commerciaux.commissions', compact('commissions'));
    }



    public function detailsSouscription(Subscription $souscription)
    {
        $commercial = Auth::user();
        
        if (!$commercial->isCommercial() || $souscription->user_id !== $commercial->id) {
            abort(403, 'Accès non autorisé');
        }

        $souscription->load(['user', 'payments', 'enterpriseDocuments']);

        return view('commerciaux.details-souscription', compact('souscription'));
    }

    public function detailsOffre(OffreEtService $offre)
    {
        $commercial = Auth::user();
        
        if (!$commercial->isCommercial()) {
            abort(403, 'Accès non autorisé');
        }

        return view('commerciaux.details-offre', compact('offre'));
    }

    public function entreprises(Request $request)
    {
        $commercial = Auth::user();
        
        if (!$commercial->isCommercial()) {
            abort(403, 'Accès non autorisé');
        }

        $query = User::where('role', 'entreprise')
            ->withCount(['offresEtServices', 'commissions', 'subscriptions'])
            ->latest();

        // Filtres
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('pays')) {
            $query->where('country', $request->pays);
        }

        $entreprises = $query->paginate(12);

        return view('commerciaux.entreprises', compact('entreprises'));
    }

    public function detailsEntreprise(User $entreprise)
    {
        $commercial = Auth::user();
        
        if (!$commercial->isCommercial()) {
            abort(403, 'Accès non autorisé');
        }

        // Vérifier que c'est bien une entreprise
        if ($entreprise->role !== 'entreprise') {
            abort(404, 'Entreprise non trouvée');
        }

        // Charger les relations
        $entreprise->load(['offresEtServices', 'commissions', 'subscriptions']);

        return view('commerciaux.details-entreprise', compact('entreprise'));
    }

    public function editProfile()
    {
        $user = Auth::user();
        return view('commerciaux.profile.edit', compact('user'));
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

        return redirect()->route('commerciaux.profile.edit')->with('success', 'Profil mis à jour avec succès.');
    }

    public function editPassword()
    {
        return view('commerciaux.profile.password');
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

        return redirect()->route('commerciaux.profile.edit')->with('success', 'Mot de passe mis à jour avec succès.');
    }
}