<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'jewelry_id',
        'quantity',
        'total_price',
        'grand_total_price',
    ];

    public function jewelry() : BelongsTo {
        return $this->belongsTo(Jewelry::class, 'jewelry_id');
    }
}
