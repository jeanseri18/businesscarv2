<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Subscription extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'user_id',
        'type',
        'sector',
        'sub_sector',
        'duration_months',
        'price',
        'payment_method',
        'payment_status',
        'commission_amount',
        'commission_rate',
        'start_date',
        'end_date',
        'expires_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'price' => 'decimal:2',
        'duration_months' => 'integer',
    ];

    /**
     * Get the user that owns the subscription.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the commercial that manages the subscription.
     */
    public function commercial(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the subscription form for the subscription.
     */
    public function subscriptionForm(): HasOne
    {
        return $this->hasOne(SubscriptionForm::class);
    }

    /**
     * Get the enterprise documents for the subscription.
     */
    public function enterpriseDocuments(): HasMany
    {
        return $this->hasMany(EnterpriseDocument::class);
    }

    /**
     * Get the business cards for the subscription.
     */
    public function businessCards(): HasMany
    {
        return $this->hasMany(BusinessCard::class);
    }

    /**
     * Get the payments for the subscription.
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Check if the subscription is active.
     */
    public function isActive(): bool
    {
        return $this->payment_status === 'paid' && 
               $this->start_date <= now() && 
               $this->end_date >= now();
    }

    /**
     * Check if the subscription is expired.
     */
    public function isExpired(): bool
    {
        return $this->end_date < now();
    }
}