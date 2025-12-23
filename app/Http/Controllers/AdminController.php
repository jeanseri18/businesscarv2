<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Subscription;
use App\Models\Payment;
use App\Models\Achat;
use App\Models\EnterpriseDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            Auth::login($user);
            
            // Rediriger vers le dashboard approprié selon le rôle
            if ($user->isAdmin()) {
                return redirect()->route('admin.dashboard');
            } elseif ($user->isCommercial()) {
                return redirect()->route('commercial.dashboard');
            } elseif ($user->isEntreprise()) {
                return redirect()->route('entreprise.dashboard');
            }
        }

        return back()->withErrors([
            'email' => 'Les identifiants sont incorrects ou vous n\'avez pas les droits d\'accès.',
        ]);
    }

    public function logout()
    {
        $user = Auth::user();
        Auth::logout();
        
        // Rediriger vers la page de login appropriée selon le rôle
        if ($user && $user->isCommercial()) {
            return redirect()->route('commercial.login');
        }
        
        return redirect()->route('admin.login');
    }

    public function dashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'total_subscriptions' => Subscription::count(),
            'total_payments' => Payment::count(),
            'total_achats' => Achat::count(),
            'pending_subscriptions' => Subscription::where('payment_status', 'pending')->count(),
            'completed_payments' => Payment::where('status', 'completed')->count(),
            'recent_users' => User::latest()->limit(5)->get(),
            'recent_subscriptions' => Subscription::with('user')->latest()->limit(5)->get(),
            'recent_payments' => Payment::with('subscription.user')->latest()->limit(5)->get(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    public function users()
    {
        $users = User::latest()->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    public function userDetails(User $user)
    {
        $user->load(['subscriptions', 'businessCards', 'auditLogs']);
        return view('admin.users.details', compact('user'));
    }

    public function enterprises()
    {
        $enterprises = User::where('role', 'entreprise')
            ->with(['subscriptions.enterpriseDocuments'])
            ->latest()
            ->paginate(20);
        
        return view('admin.enterprises.index', compact('enterprises'));
    }

    public function enterpriseDetails(User $enterprise)
    {
        $enterprise->load([
            'subscriptions.enterpriseDocuments',
            'subscriptions.businessCards',
            'offresEtServices'
        ]);
        
        return view('admin.enterprises.details', compact('enterprise'));
    }

    public function subscriptions()
    {
        $subscriptions = Subscription::with(['user', 'payments'])
            ->latest()
            ->paginate(20);
        
        return view('admin.subscriptions.index', compact('subscriptions'));
    }

    public function subscriptionDetails(Subscription $subscription)
    {
        $subscription->load(['user', 'payments', 'enterpriseDocuments', 'businessCards']);
        
        return view('admin.subscriptions.details', compact('subscription'));
    }

    public function payments()
    {
        $payments = Payment::with(['subscription.user'])
            ->latest()
            ->paginate(20);
        
        $totalReceived = Payment::where('status', 'completed')->sum('amount');
        $totalPending = Payment::where('status', 'pending')->sum('amount');
        $totalRefunded = Payment::where('status', 'refunded')->sum('amount');
        $totalFailed = Payment::where('status', 'failed')->sum('amount');
        
        return view('admin.payments.index', compact('payments', 'totalReceived', 'totalPending', 'totalRefunded', 'totalFailed'));
    }

    public function paymentDetails(Payment $payment)
    {
        $payment->load(['subscription.user']);
        
        return view('admin.payments.details', compact('payment'));
    }

    public function achats()
    {

           $offres = \App\Models\OffreEtService::with(['entreprise', 'achats'])
            ->latest()
            ->paginate(20);
        $achats = Achat::with(['produitService'])
            ->latest()
            ->paginate(20);
           $offres = \App\Models\OffreEtService::with(['entreprise', 'achats'])
            ->latest()
            ->paginate(20);
        $totalSales = Achat::where('statut', 'completed')
            ->join('offreetservice', 'achat.id_produit_service', '=', 'offreetservice.id')
            ->selectRaw('SUM(achat.quantite * offreetservice.prix) as total')
            ->value('total') ?? 0;
            
        $totalPending = Achat::where('statut', 'en_attente')
            ->join('offreetservice', 'achat.id_produit_service', '=', 'offreetservice.id')
            ->selectRaw('SUM(achat.quantite * offreetservice.prix) as total')
            ->value('total') ?? 0;
            
        $totalRefunded = Achat::where('statut', 'annule')
            ->join('offreetservice', 'achat.id_produit_service', '=', 'offreetservice.id')
            ->selectRaw('SUM(achat.quantite * offreetservice.prix) as total')
            ->value('total') ?? 0;
        $totalCount = Achat::count();
        
        return view('admin.purchases.index', compact('achats', 'totalSales', 'totalPending', 'totalRefunded', 'totalCount','offres'));
    }

    public function achatDetails(Achat $achat)
    {
        $achat->load(['produitService', 'commissions']);
        
        return view('admin.purchases.details', compact('achat'));
    }

    public function updateSubscriptionStatus(Subscription $subscription, Request $request)
    {
        $request->validate([
            'payment_status' => 'required|in:pending,paid,failed',
        ]);

        $subscription->update(['payment_status' => $request->payment_status]);

        return back()->with('success', 'Statut de la souscription mis à jour avec succès.');
    }

    public function updatePaymentStatus(Payment $payment, Request $request)
    {
        $request->validate([
            'status' => 'required|in:pending,completed,failed,refunded',
        ]);

        $payment->update(['status' => $request->status]);

        return back()->with('success', 'Statut du paiement mis à jour avec succès.');
    }

    public function editProfile()
    {
        $user = Auth::user();
        return view('admin.profile.edit', compact('user'));
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

        return redirect()->route('admin.profile.edit')->with('success', 'Profil mis à jour avec succès.');
    }

    public function editPassword()
    {
        return view('admin.profile.password');
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

        return redirect()->route('admin.profile.edit')->with('success', 'Mot de passe mis à jour avec succès.');
        

        if ($request->status === 'completed') {
            $payment->markAsCompleted();
        } elseif ($request->status === 'failed') {
            $payment->markAsFailed();
        } elseif ($request->status === 'refunded') {
            $payment->markAsRefunded();
        } else {
            $payment->update(['status' => $request->status]);
        }

        return back()->with('success', 'Statut du paiement mis à jour avec succès.');
    }

    public function updateAchatStatus(Achat $achat, Request $request)
    {
        $request->validate([
            'statut' => 'required|in:en_attente,confirme,livre,annule',
        ]);

        switch ($request->statut) {
            case 'confirme':
                $achat->markAsConfirme();
                break;
            case 'livre':
                $achat->markAsLivre();
                break;
            case 'annule':
                $achat->markAsAnnule();
                break;
            default:
                $achat->update(['statut' => $request->statut]);
        }

        return back()->with('success', 'Statut de l\'achat mis à jour avec succès.');
    }

    public function commerciaux()
    {
        $commerciaux = User::where('role', 'commercial')
            ->with(['subscriptions', 'commissions'])
            ->latest()
            ->paginate(20);
        
        return view('admin.commerciaux.index', compact('commerciaux'));
    }

    public function commercialDetails(User $commercial)
    {
        $commercial->load([
            'subscriptions',
            'commissions.achat.produitService',
            'auditLogs'
        ]);
        
        // Calculate commission statistics
        $totalCommissions = $commercial->commissions()->sum('montant');
        $paidCommissions = $commercial->commissions()->where('statut', 'paye')->sum('montant');
        $pendingCommissions = $commercial->commissions()->where('statut', 'en_attente')->sum('montant');
        
        return view('admin.commerciaux.details', compact('commercial', 'totalCommissions', 'paidCommissions', 'pendingCommissions'));
    }

    public function updateCommercialStatus(User $commercial, Request $request)
    {
        $request->validate([
            'status' => 'required|in:active,inactive',
        ]);

        // Update the commercial status (you might want to add a status column to users table)
        // For now, we'll just return a success message
        return back()->with('success', 'Statut du commercial mis à jour avec succès.');
    }

    public function deleteCommercial(User $commercial)
    {
        // Check if commercial has any active subscriptions or commissions
        if ($commercial->subscriptions()->exists() || $commercial->commissions()->exists()) {
            return back()->with('error', 'Impossible de supprimer ce commercial car il a des souscriptions ou des commissions associées.');
        }

        $commercial->delete();
        return back()->with('success', 'Commercial supprimé avec succès.');
    }

    /**
     * AJAX: Update subscription status
     */
    public function ajaxUpdateSubscriptionStatus(Subscription $subscription, Request $request)
    {
        $request->validate([
            'status' => 'required|in:active,expired,cancelled,pending',
        ]);

        $oldStatus = $subscription->status;
        $subscription->update(['status' => $request->status]);

        // Log the status change
        audit_log(
            'subscription_status_updated',
            "Subscription status changed from {$oldStatus} to {$request->status}",
            ['subscription_id' => $subscription->id, 'old_status' => $oldStatus, 'new_status' => $request->status]
        );

        return response()->json([
            'success' => true,
            'message' => 'Subscription status updated successfully',
            'subscription' => $subscription->fresh(),
        ]);
    }

    /**
     * AJAX: Update payment status
     */
    public function ajaxUpdatePaymentStatus(Payment $payment, Request $request)
    {
        $request->validate([
            'status' => 'required|in:completed,pending,failed,refunded',
        ]);

        $oldStatus = $payment->status;
        $payment->update(['status' => $request->status]);

        // Log the status change
        audit_log(
            'payment_status_updated',
            "Payment status changed from {$oldStatus} to {$request->status}",
            ['payment_id' => $payment->id, 'old_status' => $oldStatus, 'new_status' => $request->status]
        );

        return response()->json([
            'success' => true,
            'message' => 'Payment status updated successfully',
            'payment' => $payment->fresh(),
        ]);
    }

    /**
     * AJAX: Update purchase status
     */
    public function ajaxUpdateAchatStatus(Achat $achat, Request $request)
    {
        $request->validate([
            'status' => 'required|in:pending,completed,refunded,cancelled',
        ]);

        $oldStatus = $achat->statut;
        $achat->update(['statut' => $request->status]);

        // Log the status change
        audit_log(
            'purchase_status_updated',
            "Purchase status changed from {$oldStatus} to {$request->status}",
            ['achat_id' => $achat->id, 'old_status' => $oldStatus, 'new_status' => $request->status]
        );

        return response()->json([
            'success' => true,
            'message' => 'Purchase status updated successfully',
            'achat' => $achat->fresh(),
        ]);
    }

    /**
     * Display all offers
     */
    public function offres()
    {
        $offres = \App\Models\OffreEtService::with(['entreprise', 'achats'])
            ->latest()
            ->paginate(20);
        
        $totalOffres = \App\Models\OffreEtService::count();
        $totalVentes = \App\Models\Achat::whereHas('produitService')->sum('quantite');
        $totalRevenue = \App\Models\Achat::whereHas('produitService')
            ->join('offreetservice', 'achat.id_produit_service', '=', 'offreetservice.id')
            ->selectRaw('SUM(achat.quantite * offreetservice.prix) as total')
            ->value('total') ?? 0;
        
        return view('admin.offres.index', compact('offres', 'totalOffres', 'totalVentes', 'totalRevenue'));
    }

    /**
     * Store a new purchase
     */
    public function storeAchat(Request $request)
    {
        $request->validate([
            'id_produit_service' => 'required|exists:offreetservice,id',
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'type' => 'required|in:produit,service',
            'quantite' => 'required|integer|min:1',
            'whatsapp' => 'nullable|string|max:20',
            'description' => 'nullable|string',
            'lieu_livraison' => 'nullable|string|max:255',
            'date_livraison' => 'nullable|date',
            'notes' => 'nullable|string',
            'code_commercial' => 'nullable|string|max:50',
        ]);

        // Get the product/service to calculate commission
        $produitService = \App\Models\OffreEtService::find($request->id_produit_service);
        $montantTotal = $produitService->prix * $request->quantite;
        
        // Find commercial user by code_commercial if provided
        $commercialId = null;
        if ($request->code_commercial) {
            $commercialUser = \App\Models\User::where('code_commercial', $request->code_commercial)->first();
            $commercialId = $commercialUser ? $commercialUser->id : null;
        }
        
        // Create the purchase
        $achat = Achat::create([
            'user_id' => auth()->id(),
            'commercial_id' => $commercialId ?? $produitService->entreprise->commercial_id ?? null,
            'id_produit_service' => $request->id_produit_service,
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'type' => $request->type,
            'quantite' => $request->quantite,
            'whatsapp' => $request->whatsapp,
            'description' => $request->description,
            'lieu_livraison' => $request->lieu_livraison,
            'date_livraison' => $request->date_livraison,
            'notes' => $request->notes,
            'statut' => 'en_attente',
            'code_commercial' => $request->code_commercial,
        ]);

        // Create commission for commercial if applicable
        if ($produitService->entreprise && $produitService->entreprise->commercial_id) {
            $commissionRate = 0.1; // 10% commission rate
            $commissionAmount = $montantTotal * $commissionRate;
            
            CommissionCommercial::create([
                'identreprise' => $produitService->entreprise->commercial_id,
                'id_achat' => $achat->id,
                'id_produit' => $produitService->id,
                'montant' => $commissionAmount,
                'statut' => 'en_attente',
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Achat créé avec succès!',
            'achat' => $achat->load(['produitService', 'user']),
        ]);
    }

    /**
     * Store a new purchase from public form (no authentication required)
     */
    public function storeAchatPublic(Request $request)
    {
        $request->validate([
            'id_produit_service' => 'required|exists:offreetservice,id',
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'type' => 'required|in:particulier,entreprise',
            'quantite' => 'required|integer|min:1',
            'whatsapp' => 'required|string|max:20',
            'description' => 'nullable|string',
            'lieu_livraison' => 'nullable|string|max:255',
            'date_livraison' => 'nullable|date',
            'notes' => 'nullable|string',
            'code_commercial' => 'nullable|string|max:50',
        ]);

        // Get the product/service to calculate commission
        $produitService = \App\Models\OffreEtService::find($request->id_produit_service);
        $montantTotal = $produitService->prix * $request->quantite;
        
        // Find commercial user by code_commercial if provided
        $commercialId = null;
        if ($request->code_commercial) {
            $commercialUser = \App\Models\User::where('code_commercial', $request->code_commercial)->first();
            $commercialId = $commercialUser ? $commercialUser->id : null;
        }
        
        // Create the purchase
        $achat = Achat::create([
            'user_id' => null, // No authenticated user for public purchases
            'commercial_id' => $commercialId ?? $produitService->entreprise->commercial_id ?? null,
            'id_produit_service' => $request->id_produit_service,
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'type' => $request->type,
            'quantite' => $request->quantite,
            'whatsapp' => $request->whatsapp,
            'description' => $request->description,
            'lieu_livraison' => $request->lieu_livraison,
            'date_livraison' => $request->date_livraison,
            'notes' => $request->notes,
            'statut' => 'en_attente',
            'code_commercial' => $request->code_commercial,
        ]);

        // Create commission for commercial if applicable
        if ($produitService->entreprise && $produitService->entreprise->commercial_id) {
            $commissionRate = 0.1; // 10% commission rate
            $commissionAmount = $montantTotal * $commissionRate;
            
            CommissionCommercial::create([
                'identreprise' => $produitService->entreprise->commercial_id,
                'id_achat' => $achat->id,
                'id_produit' => $produitService->id,
                'montant' => $commissionAmount,
                'statut' => 'en_attente',
            ]);
        }

        return redirect()->back()->with('success', 'Votre commande a été enregistrée avec succès! Nous vous contacterons bientôt.');
    }
}