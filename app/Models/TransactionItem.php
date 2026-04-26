<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionItem extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'transaction_id', 'product_id', 'quantity', 'price', 'total'
    ];

    protected static function booted()
    {
        static::saving(function ($item){
            $item->total = $item->quantity * $item->price;
        });
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
