<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    public const STATUSES = ['pending', 'processing', 'completed', 'cancelled'];

    public const PAYMENT_STATUSES = ['unpaid', 'paid'];

    protected $fillable = [
        'user_id',
        'order_number',
        'full_name',
        'email',
        'phone',
        'delivery_address',
        'city',
        'payment_method',
        'status',
        'payment_status',
        'subtotal',
        'total',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
