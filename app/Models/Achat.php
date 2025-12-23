<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Achat extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'achat';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'commercial_id',
        'nom',
        'prenom',
        'type',
        'whatsapp',
        'code_commercial',
        'quantite',
        'description',
        'lieu_livraison',
        'date_livraison',
        'statut',
        'id_produit_service',
        'notes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'quantite' => 'integer',
        'date_livraison' => 'date',
    ];

    /**
     * Get the product/service for the purchase.
     */
    public function produitService(): BelongsTo
    {
        return $this->belongsTo(OffreEtService::class, 'id_produit_service');
    }

    /**
     * Get the user that made the purchase.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the commercial that managed the purchase.
     */
    public function commercial(): BelongsTo
    {
        return $this->belongsTo(User::class, 'commercial_id');
    }

    /**
     * Get the commissions for the purchase.
     */
    public function commissions(): HasMany
    {
        return $this->hasMany(CommissionCommercial::class, 'id_achat');
    }

    /**
     * Check if it's a product purchase.
     */
    public function isProduit(): bool
    {
        return $this->type === 'produit';
    }

    /**
     * Check if it's a service purchase.
     */
    public function isService(): bool
    {
        return $this->type === 'service';
    }

    /**
     * Check if the purchase is pending.
     */
    public function isEnAttente(): bool
    {
        return $this->statut === 'en_attente';
    }

    /**
     * Check if the purchase is confirmed.
     */
    public function isConfirme(): bool
    {
        return $this->statut === 'confirme';
    }

    /**
     * Check if the purchase is delivered.
     */
    public function isLivre(): bool
    {
        return $this->statut === 'livre';
    }

    /**
     * Check if the purchase is cancelled.
     */
    public function isAnnule(): bool
    {
        return $this->statut === 'annule';
    }

    /**
     * Mark the purchase as confirmed.
     */
    public function markAsConfirme(): void
    {
        $this->update(['statut' => 'confirme']);
    }

    /**
     * Mark the purchase as delivered.
     */
    public function markAsLivre(): void
    {
        $this->update(['statut' => 'livre']);
    }

    /**
     * Mark the purchase as cancelled.
     */
    public function markAsAnnule(): void
    {
        $this->update(['statut' => 'annule']);
    }

    /**
     * Get the full name.
     */
    public function getFullNameAttribute(): string
    {
        return $this->prenom . ' ' . $this->nom;
    }

    /**
     * Get the total amount.
     */
    public function getMontantTotalAttribute(): float
    {
        return $this->quantite * ($this->produitService->prix ?? 0);
    }
}