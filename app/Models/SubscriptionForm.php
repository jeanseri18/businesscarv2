<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubscriptionForm extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'subscription_id',
        'last_name',
        'first_name',
        'cni_number',
        'age',
        'education_level',
        'location',
        'phone',
        'whatsapp',
        'email',
        'country',
        'nationality',
        'photo_path',
        'cni_photocopy_path',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'age' => 'integer',
    ];

    /**
     * Get the subscription that owns the form.
     */
    public function subscription(): BelongsTo
    {
        return $this->belongsTo(Subscription::class);
    }

    /**
     * Get the full name attribute.
     */
    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * Get the photo URL attribute.
     */
    public function getPhotoUrlAttribute(): ?string
    {
        return $this->photo_path ? asset('storage/' . $this->photo_path) : null;
    }

    /**
     * Get the CNI photocopy URL attribute.
     */
    public function getCniPhotocopyUrlAttribute(): ?string
    {
        return $this->cni_photocopy_path ? asset('storage/' . $this->cni_photocopy_path) : null;
    }
}