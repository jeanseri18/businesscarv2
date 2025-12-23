<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'type',
        'description',
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
     * Scope a query to only include active sectors.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to only include sectors of a specific type.
     */
    public function scopeByType($query, string $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Get the type label attribute.
     */
    public function getTypeLabelAttribute(): string
    {
        return match($this->type) {
            'primaire' => 'Secteur Primaire',
            'secondaire' => 'Secteur Secondaire',
            'tertiaire' => 'Secteur Tertiaire',
            'premium' => 'Premium',
            default => $this->type,
        };
    }

    /**
     * Check if the sector is primary.
     */
    public function isPrimary(): bool
    {
        return $this->type === 'primaire';
    }

    /**
     * Check if the sector is secondary.
     */
    public function isSecondary(): bool
    {
        return $this->type === 'secondaire';
    }

    /**
     * Check if the sector is tertiary.
     */
    public function isTertiary(): bool
    {
        return $this->type === 'tertiaire';
    }

    /**
     * Check if the sector is premium.
     */
    public function isPremium(): bool
    {
        return $this->type === 'premium';
    }
}