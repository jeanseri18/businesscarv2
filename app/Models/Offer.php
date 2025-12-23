<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Offer extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'price',
        'duration',
        'features',
        'status'
    ];

    protected $casts = [
        'features' => 'array',
        'price' => 'decimal:2',
        'duration' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the subscriptions for this offer.
     */
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class, 'offre_id');
    }

    public function getStatusBadgeClassAttribute(): string
    {
        return match($this->status) {
            'active' => 'bg-green-100 text-green-800',
            'inactive' => 'bg-gray-100 text-gray-800',
            default => 'bg-gray-100 text-gray-800'
        };
    }

    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'active' => 'Active',
            'inactive' => 'Inactive',
            default => 'Inconnu'
        };
    }

    public function getFormattedPriceAttribute(): string
    {
        return number_format($this->price, 2, ',', ' ') . ' €';
    }

    public function getDurationLabelAttribute(): string
    {
        return $this->duration . ' ' . ($this->duration > 1 ? 'mois' : 'mois');
    }
}