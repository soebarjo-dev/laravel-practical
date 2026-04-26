<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'email', 'password', 'created_by', 'updated_by', 'deleted_by'
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
