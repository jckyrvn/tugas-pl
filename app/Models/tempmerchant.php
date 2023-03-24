<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tempmerchant extends Model
{
    protected $table = 'tempmerchant';
    protected $fillable = [
        'seller_id',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'seller_id');
    }
}
