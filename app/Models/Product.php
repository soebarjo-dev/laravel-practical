<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'unit_id', 'name', 'price', 'created_by', 'updated_by', 'deleted_by'
    ];

    protected $casts = [
        'price' => 'integer'
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function transactionItems()
    {
        return $this->hasMany(TransactionItem::class);
    }
}
