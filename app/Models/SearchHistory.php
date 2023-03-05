<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SearchHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'max_price',
        'min_price',
        'type'
    ];

    public function search_history_products(): HasMany
    {
        return $this->hasMany(SearchHistoryProduct::class);
    }
}
