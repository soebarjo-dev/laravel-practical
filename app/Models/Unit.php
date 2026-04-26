<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'name', 'symbol', 'created_at', 'created_by'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
