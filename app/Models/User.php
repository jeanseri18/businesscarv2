<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    // pour laravel sanctum
    use HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'country',
        'nationality',
        'accept_terms',
        'role',
        'code_commercial',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = 
         [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'accept_terms' => 'boolean',
            'role' => 'string',
        ];
    
    // protected function casts(): array
    // {
    //     return [
    //         'email_verified_at' => 'datetime',
    //         'password' => 'hashed',
    //         'accept_terms' => 'boolean',
    //         'role' => 'string',
    //     ];
    // }

    /**
     * Get the subscriptions for the user.
     */
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    /**
     * Get the business cards for the user.
     */
    public function businessCards()
    {
        return $this->hasMany(BusinessCard::class);
    }

    /**
     * Get the audit logs for the user.
     */
    public function auditLogs(): HasMany
    {
        return $this->hasMany(AuditLog::class);
    }

    /**
     * Get the offers and services for the enterprise.
     */
    public function offresEtServices(): HasMany
    {
        return $this->hasMany(OffreEtService::class, 'identreprise');
    }

    /**
     * Get the commissions for the enterprise.
     */
    public function commissions(): HasMany
    {
        return $this->hasMany(CommissionCommercial::class, 'identreprise');
    }

    /**
     * Find user by code_commercial.
     */
    public static function findByCodeCommercial(string $code): ?self
    {
        return self::where('code_commercial', $code)->first();
    }

    /**
     * Check if the user is a commercial.
     */
    public function isCommercial(): bool
    {
        return $this->role === 'commercial';
    }

    /**
     * Check if the user is an enterprise.
     */
    public function isEntreprise(): bool
    {
        return $this->role === 'entreprise';
    }

    /**
     * Check if the user is an admin.
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
}
