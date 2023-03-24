<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'master_data_product';
    protected $fillable = [
        'id',
        'name_product',
        'description',
        'subprice',
        'discount',
        'price',
        'seller_id',
        'media',
        'stock',
    ];
}
