<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JewelrySize extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'jewelry_id',
        'size',
    ];

    public function jewelry(): BelongsTo {
        return $this->belongsTo(Jewelry::class, 'jewelry_id');
    }

}
