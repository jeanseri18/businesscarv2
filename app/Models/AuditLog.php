<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AuditLog extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'user_id',
        'action',
        'entity_type',
        'entity_id',
        'old_values',
        'new_values',
        'ip_address',
        'user_agent',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'old_values' => 'array',
        'new_values' => 'array',
    ];

    /**
     * Get the user that created the audit log.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope a query to only include logs for a specific entity type.
     */
    public function scopeForEntityType($query, string $entityType)
    {
        return $query->where('entity_type', $entityType);
    }

    /**
     * Scope a query to only include logs for a specific entity ID.
     */
    public function scopeForEntityId($query, int $entityId)
    {
        return $query->where('entity_id', $entityId);
    }

    /**
     * Scope a query to only include logs for a specific action.
     */
    public function scopeForAction($query, string $action)
    {
        return $query->where('action', $action);
    }

    /**
     * Scope a query to only include logs for a specific user.
     */
    public function scopeForUser($query, int $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Get the formatted action attribute.
     */
    public function getFormattedActionAttribute(): string
    {
        return match($this->action) {
            'create' => 'Création',
            'update' => 'Modification',
            'delete' => 'Suppression',
            'login' => 'Connexion',
            'logout' => 'Déconnexion',
            'payment' => 'Paiement',
            'subscription' => 'Abonnement',
            default => ucfirst($this->action),
        };
    }

    /**
     * Get the formatted entity type attribute.
     */
    public function getFormattedEntityTypeAttribute(): string
    {
        return match($this->entity_type) {
            'user' => 'Utilisateur',
            'subscription' => 'Abonnement',
            'payment' => 'Paiement',
            'business_card' => 'Carte de visite',
            'subscription_form' => 'Formulaire d\'abonnement',
            'enterprise_document' => 'Document d\'entreprise',
            default => ucfirst($this->entity_type),
        };
    }

    /**
     * Check if the log has changes.
     */
    public function hasChanges($changes = null, $attributes = null): bool
    {
        return !empty($this->old_values) || !empty($this->new_values);
    }

    /**
     * Get the changes as a formatted string.
     */
    public function getChangesDescription(): string
    {
        if (!$this->hasChanges()) {
            return 'Aucune modification détectée';
        }

        $changes = [];
        
        if ($this->old_values) {
            $changes[] = 'Anciennes valeurs: ' . json_encode($this->old_values);
        }
        
        if ($this->new_values) {
            $changes[] = 'Nouvelles valeurs: ' . json_encode($this->new_values);
        }

        return implode(' | ', $changes);
    }
}