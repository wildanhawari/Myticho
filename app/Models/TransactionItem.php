<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransactionItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'jewelry_transaction_id',
        'jewelry_id',
        'quantity',
        'sub_total_amount',
    ];

    public function transaction()
    {
        return $this->belongsTo(JewelryTransaction::class, 'jewelry_transaction_id');
    }

    public function jewelry()
    {
        return $this->belongsTo(Jewelry::class, 'jewelry_id');
    }
}
