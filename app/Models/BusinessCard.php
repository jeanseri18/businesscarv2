<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BusinessCard extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'user_id',
        'subscription_id',
        'card_number',
        'qr_code',
        'status',
        'generated_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'generated_at' => 'datetime',
        'status' => 'string',
    ];

    /**
     * Get the user that owns the business card.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the subscription that owns the business card.
     */
    public function subscription(): BelongsTo
    {
        return $this->belongsTo(Subscription::class);
    }

    /**
     * Check if the card is active.
     */
    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    /**
     * Check if the card is expired.
     */
    public function isExpired(): bool
    {
        return $this->status === 'expired';
    }

    /**
     * Check if the card is inactive.
     */
    public function isInactive(): bool
    {
        return $this->status === 'inactive';
    }

    /**
     * Activate the card.
     */
    public function activate(): void
    {
        $this->update(['status' => 'active']);
    }

    /**
     * Deactivate the card.
     */
    public function deactivate(): void
    {
        $this->update(['status' => 'inactive']);
    }

    /**
     * Expire the card.
     */
    public function expire(): void
    {
        $this->update(['status' => 'expired']);
    }

    /**
     * Get the QR code URL attribute.
     */
    public function getQrCodeUrlAttribute(): ?string
    {
        return $this->qr_code ? asset('storage/' . $this->qr_code) : null;
    }
}