<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function product(){
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
