<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OffreEtService extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'offreetservice';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'type',
        'nom',
        'prix',
        'identreprise',
        'pdf_path',
        'photo_path',
        'detail',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'prix' => 'decimal:2',
    ];

    /**
     * Get the enterprise that owns the offer/service.
     */
    public function entreprise(): BelongsTo
    {
        return $this->belongsTo(User::class, 'identreprise');
    }

    /**
     * Get the purchases for the offer/service.
     */
    public function achats(): HasMany
    {
        return $this->hasMany(Achat::class, 'id_produit_service');
    }

    /**
     * Get the commissions for the offer/service.
     */
    public function commissions(): HasMany
    {
        return $this->hasMany(CommissionCommercial::class, 'id_produit');
    }

    /**
     * Check if it's a product.
     */
    public function isProduit(): bool
    {
        return $this->type === 'produit';
    }

    /**
     * Check if it's a service.
     */
    public function isService(): bool
    {
        return $this->type === 'service';
    }

    /**
     * Get the PDF URL.
     */
    public function getPdfUrlAttribute(): ?string
    {
        return $this->pdf_path ? asset('storage/' . $this->pdf_path) : null;
    }

    /**
     * Get the photo URL.
     */
    public function getPhotoUrlAttribute(): ?string
    {
        return $this->photo_path ? asset('storage/' . $this->photo_path) : null;
    }
}