<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Pest\ArchPresets\Custom;

class Transaction extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id', 'customer_id', 'invoice_number', 'transaction_date', 'subtotal',
        'tax_percent', 'tax_amount', 'grand_total', 'created_at'
    ];

    protected $casts = [
        'transaction_date' => 'date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function items()
    {
        return $this->hasMany(TransactionItem::class);
    }

    public function calculateTotals()
    {
        $subtotal = $this->items->sum('total');

        $this->subtotal = $subtotal;
        $this->tax_amount = ($this->tax_percent / 100) * $subtotal;
        $this->grandTotal = $subtotal + $this->tax_amount;
    }
}
