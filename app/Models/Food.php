<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Food extends Model
{
    use HasFactory;

    protected $table = 'foods';

    protected $fillable = [
        'restaurant_id',
        'category_id',
        'name',
        'description',
        'price',
        'image',
        'is_available',
        'preparation_time',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'is_available' => 'boolean',
            'preparation_time' => 'integer',
        ];
    }

    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function getAverageRatingAttribute(): float
    {
        return round($this->reviews()->avg('rating') ?? 5.0, 1);
    }

    public function getReviewsCountAttribute(): int
    {
        return $this->reviews()->count();
    }

    public function getLocalizedNameAttribute(): string
    {
        if (app()->getLocale() === 'km') {
            $key = $this->getMenuKey();
            if ($key && ($trans = config("menu_km.foods.{$key}.name"))) {
                return $trans;
            }
        }

        return (string) ($this->name ?? '');
    }

    public function getLocalizedDescriptionAttribute(): ?string
    {
        if (app()->getLocale() === 'km') {
            $key = $this->getMenuKey();
            if ($key && ($trans = config("menu_km.foods.{$key}.description"))) {
                return $trans;
            }
        }

        return $this->description;
    }

    public function getMenuKey(): ?string
    {
        if (empty($this->name)) {
            return null;
        }

        $name = strtolower($this->name);
        if (str_contains($name, 'amok')) {
            return 'royal-fish-amok';
        }
        if (str_contains($name, 'lok lak')) {
            return 'beef-lok-lak';
        }
        if (str_contains($name, 'curry')) {
            return 'red-curry-chicken';
        }
        if (str_contains($name, 'skewers')) {
            return 'beef-skewers';
        }
        if (str_contains($name, 'kuy teav')) {
            return 'kuy-teav-special';
        }
        if (str_contains($name, 'nom banh chok')) {
            return 'nom-banh-chok';
        }
        if (str_contains($name, 'mi char')) {
            return 'mi-char';
        }
        if (str_contains($name, 'angus')) {
            return 'angkor-burger';
        }
        if (str_contains($name, 'chicken burger')) {
            return 'chicken-burger';
        }
        if (str_contains($name, 'pepperoni')) {
            return 'pepperoni-pizza';
        }
        if (str_contains($name, 'margherita') || str_contains($name, 'truffle')) {
            return 'margherita-pizza';
        }
        if (str_contains($name, 'coffee')) {
            return 'iced-coffee';
        }
        if (str_contains($name, 'jasmine') || str_contains($name, 'tea')) {
            return 'jasmine-tea';
        }
        if (str_contains($name, 'boba')) {
            return 'boba-milk';
        }
        if (str_contains($name, 'mango')) {
            return 'mango-sticky-rice';
        }
        if (str_contains($name, 'lava')) {
            return 'chocolate-lava';
        }

        return null;
    }
}
