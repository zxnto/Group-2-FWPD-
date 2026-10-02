<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'icon',
    ];

    protected static function booted()
    {
        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });
    }

    public function foods(): HasMany
    {
        return $this->hasMany(Food::class);
    }

    public function getLocalizedNameAttribute(): string
    {
        if (app()->getLocale() === 'km') {
            return config("menu_km.categories.{$this->slug}") ?? (string) ($this->name ?? '');
        }

        return (string) ($this->name ?? '');
    }
}
