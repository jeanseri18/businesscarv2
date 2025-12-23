<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'subscription_id',
        'amount',
        'currency',
        'payment_method',
        'transaction_id',
        'status',
        'paid_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'amount' => 'decimal:2',
        'paid_at' => 'datetime',
        'status' => 'string',
    ];

    /**
     * Get the subscription that owns the payment.
     */
    public function subscription(): BelongsTo
    {
        return $this->belongsTo(Subscription::class);
    }

    /**
     * Check if the payment is completed.
     */
    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    /**
     * Check if the payment is pending.
     */
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    /**
     * Check if the payment is failed.
     */
    public function isFailed(): bool
    {
        return $this->status === 'failed';
    }

    /**
     * Check if the payment is refunded.
     */
    public function isRefunded(): bool
    {
        return $this->status === 'refunded';
    }

    /**
     * Mark the payment as completed.
     */
    public function markAsCompleted(): void
    {
        $this->update([
            'status' => 'completed',
            'paid_at' => now(),
        ]);
    }

    /**
     * Mark the payment as failed.
     */
    public function markAsFailed(): void
    {
        $this->update(['status' => 'failed']);
    }

    /**
     * Mark the payment as refunded.
     */
    public function markAsRefunded(): void
    {
        $this->update(['status' => 'refunded']);
    }

    /**
     * Get the formatted amount attribute.
     */
    public function getFormattedAmountAttribute(): string
    {
        return number_format($this->amount, 2, ',', ' ') . ' ' . $this->currency;
    }

    /**
     * Get payment method icon.
     */
    public function getPaymentMethodIcon(): string
    {
        return match ($this->payment_method) {
            'credit_card' => 'credit-card',
            'bank_transfer' => 'university',
            'mobile_money' => 'mobile-alt',
            'paypal' => 'paypal',
            'cash' => 'money-bill',
            default => 'credit-card',
        };
    }

    /**
     * Get payment method label.
     */
    public function getPaymentMethodLabel(): string
    {
        return match ($this->payment_method) {
            'credit_card' => 'Carte de crédit',
            'bank_transfer' => 'Virement bancaire',
            'mobile_money' => 'Mobile Money',
            'paypal' => 'PayPal',
            'cash' => 'Espèces',
            default => 'Non spécifié',
        };
    }

    /**
     * Get status icon.
     */
    public function getStatusIcon(): string
    {
        return match ($this->status) {
            'completed' => 'check-circle',
            'pending' => 'clock',
            'failed' => 'times-circle',
            'refunded' => 'undo',
            default => 'question-circle',
        };
    }
}