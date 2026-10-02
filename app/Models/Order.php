<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'user_id',
        'restaurant_id',
        'address_id',
        'delivery_address',
        'customer_name',
        'customer_phone',
        'subtotal',
        'delivery_fee',
        'total_amount',
        'status',
        'payment_method',
        'payment_status',
        'notes',
        'cancelled_reason',
        'confirmed_at',
        'preparing_at',
        'out_for_delivery_at',
        'delivered_at',
    ];

    protected function casts(): array
    {
        return [
            'subtotal' => 'decimal:2',
            'delivery_fee' => 'decimal:2',
            'total_amount' => 'decimal:2',
            'confirmed_at' => 'datetime',
            'preparing_at' => 'datetime',
            'out_for_delivery_at' => 'datetime',
            'delivered_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function canCancel(): bool
    {
        return in_array($this->status, ['Pending', 'Confirmed']);
    }

    public function getStatusBadgeClass(): string
    {
        return match ($this->status) {
            'Pending' => 'bg-warning text-dark',
            'Confirmed' => 'bg-info text-dark',
            'Preparing' => 'bg-primary text-white',
            'Out for Delivery' => 'bg-secondary text-white',
            'Delivered' => 'bg-success text-white',
            'Cancelled' => 'bg-danger text-white',
            default => 'bg-secondary text-white',
        };
    }

    public function getProgressPercentage(): int
    {
        return match ($this->status) {
            'Pending' => 15,
            'Confirmed' => 35,
            'Preparing' => 60,
            'Out for Delivery' => 85,
            'Delivered' => 100,
            'Cancelled' => 0,
            default => 0,
        };
    }
}
