<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActiveSubscription extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'active_subscriptions';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
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
        'start_date',
        'end_date',
        'user_name',
        'user_email',
        'user_phone',
        'user_country',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'duration_months' => 'integer',
        'price' => 'decimal:2',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    /**
     * Get the user that owns the subscription.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}