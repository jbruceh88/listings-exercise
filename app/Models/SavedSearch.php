<?php

namespace App\Models;

use App\Enums\PropertyType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SavedSearch extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'property_type',
        'max_price',
        'min_bedrooms',
        'region',
    ];

    protected function casts(): array
    {
        return [
            'property_type' => PropertyType::class,
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
