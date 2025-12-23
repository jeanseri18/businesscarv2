<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CommissionCommercial extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'commission_commercial';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_achat',
        'id_produit',
        'identreprise',
        'montant',
        'statut',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'montant' => 'decimal:2',
    ];

    /**
     * Get the purchase for the commission.
     */
    public function achat(): BelongsTo
    {
        return $this->belongsTo(Achat::class, 'id_achat');
    }

    /**
     * Get the product/service for the commission.
     */
    public function produit(): BelongsTo
    {
        return $this->belongsTo(OffreEtService::class, 'id_produit');
    }

    /**
     * Get the enterprise for the commission.
     */
    public function entreprise(): BelongsTo
    {
        return $this->belongsTo(User::class, 'identreprise');
    }

    /**
     * Check if the commission is paid.
     */
    public function isPaye(): bool
    {
        return $this->statut === 'paye';
    }

    /**
     * Check if the commission is cancelled.
     */
    public function isAnnule(): bool
    {
        return $this->statut === 'annule';
    }

    /**
     * Check if the commission is pending.
     */
    public function isEnAttente(): bool
    {
        return $this->statut === 'en_attente';
    }

    /**
     * Mark the commission as paid.
     */
    public function markAsPaye(): void
    {
        $this->update(['statut' => 'paye']);
    }

    /**
     * Mark the commission as cancelled.
     */
    public function markAsAnnule(): void
    {
        $this->update(['statut' => 'annule']);
    }

    /**
     * Get the formatted amount.
     */
    public function getFormattedMontantAttribute(): string
    {
        return number_format($this->montant, 2, ',', ' ') . ' FCFA';
    }
}