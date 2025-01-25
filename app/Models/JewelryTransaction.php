<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JewelryTransaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'jewelry_id',
        'quantity',
        'sub_total_amount',
        'grand_total_amount',
        'proof',
        'bank_id',
        'is_paid',
        'transaction_trx_id',
        'status',
    ];

    public static function generateUniqueTrxId() {
        $prefix = 'Myc';
        $datetime = date('Ymdhis');
        do {
            $randString = $prefix . $datetime . mt_rand(1000,9999);
        } while (self::where('transaction_trx_id', $randString)->exists());

        return $randString;
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class, 'bank_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jewelry()
    {
        return $this->belongsTo(Jewelry::class);
    }

    public function items()
    {
        return $this->hasMany(TransactionItem::class, 'jewelry_transaction_id');
    }
}
