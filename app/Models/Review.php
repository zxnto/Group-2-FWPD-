<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'food_id',
        'order_id',
        'rating',
        'comment',
    ];

    protected function casts(): array
    {
        return [
            'rating' => 'integer',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function food(): BelongsTo
    {
        return $this->belongsTo(Food::class);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function getLocalizedCommentAttribute(): ?string
    {
        if (app()->getLocale() === 'km' && ! empty($this->comment)) {
            if (str_contains($this->comment, 'Best Kuy Teav in Phnom Penh')) {
                return 'គុយទាវភ្នំពេញឆ្ងាញ់បំផុត! ទឹកស៊ុបថ្លាមានឱជារសឈ្ងុយឆ្ងាញ់ និងគ្រឿងច្រើនសំបូរបែប។';
            }
            if (str_contains($this->comment, 'Kampot pepper sauce')) {
                return 'ទឹកជ្រលក់ម្រេចកំពតធ្វើឱ្យឡុកឡាក់នេះកាន់តែឆ្ងាញ់លើសគេ។ រសជាតិឈ្ងុយឆ្ងាញ់ ៥ ផ្កាយពេញ!';
            }
            if (str_contains($this->comment, 'Super delicious') || str_contains($this->comment, 'authentic, creamy')) {
                return 'ម្ហូបឆ្ងាញ់ខ្លាំងណាស់! អាម៉ុកត្រីមានរសជាតិដើមពិតៗ ខាប់ខ្ទិះដូង និងឈ្ងុយគ្រឿងបុកខ្មែរ។';
            }
        }

        return $this->comment;
    }
}
