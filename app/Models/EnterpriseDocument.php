<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EnterpriseDocument extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'subscription_id',
        'document_type',
        'file_path',
        'file_name',
        'file_size',
        'uploaded_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'uploaded_at' => 'datetime',
        'file_size' => 'integer',
    ];

    /**
     * Get the subscription that owns the document.
     */
    public function subscription(): BelongsTo
    {
        return $this->belongsTo(Subscription::class);
    }

    /**
     * Get the file URL attribute.
     */
    public function getFileUrlAttribute(): string
    {
        return asset('storage/' . $this->file_path);
    }

    /**
     * Get the document type label attribute.
     */
    public function getDocumentTypeLabelAttribute(): string
    {
        return match($this->document_type) {
            'rccm' => 'RCCM (Registre de Commerce)',
            'dfe' => 'DFE (Déclaration Fiscale d\'Entrée)',
            'bail' => 'Bail Commercial',
            'rib' => 'RIB (Relevé d\'Identité Bancaire)',
            default => $this->document_type,
        };
    }

    /**
     * Check if the document is an image.
     */
    public function isImage(): bool
    {
        $extension = pathinfo($this->file_name, PATHINFO_EXTENSION);
        return in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif', 'bmp']);
    }

    /**
     * Check if the document is a PDF.
     */
    public function isPdf(): bool
    {
        return pathinfo($this->file_name, PATHINFO_EXTENSION) === 'pdf';
    }
}