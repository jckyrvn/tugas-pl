<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tempcarts extends Model
{
    protected $table = 'tempcarts';
    protected $primarykey = 'id';
    protected $fillable = [
        'id',
        'id',
        'user_id',
        'seller_id',
        'product_id',
        'quantity',
        'subprice',
        'price',
    ];
}
