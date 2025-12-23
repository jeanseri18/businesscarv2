<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'code',
        'currency',
        'phone_code',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Scope a query to only include active countries.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to only include countries using a specific currency.
     */
    public function scopeByCurrency($query, string $currency)
    {
        return $query->where('currency', $currency);
    }

    /**
     * Get the formatted phone code attribute.
     */
    public function getFormattedPhoneCodeAttribute(): string
    {
        return $this->phone_code ?? '';
    }

    /**
     * Check if the country is active.
     */
    public function isActive(): bool
    {
        return $this->is_active;
    }

    /**
     * Get the currency symbol attribute.
     */
    public function getCurrencySymbolAttribute(): string
    {
        return match(strtoupper($this->currency)) {
            'XOF' => 'FCFA',
            'XAF' => 'FCFA',
            'GNF' => 'GNF',
            'GHS' => 'GH₵',
            'NGN' => '₦',
            'CDF' => 'CDF',
            default => $this->currency,
        };
    }

    /**
     * Get the full name with code attribute.
     */
    public function getFullNameAttribute(): string
    {
        return "{$this->name} ({$this->code})";
    }
}