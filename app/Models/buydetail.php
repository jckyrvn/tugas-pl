<?php

namespace App\Models;

use App\Models\buy;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class buydetail extends Model
{
    protected $table = 'buydetail';
    protected $fillable = [
        'buy_id',
        'user_id',
        'seller_id',
        'product_id',
        'quantity',
        'subprice',
        'price',
    ];
    public $incrementing = false;

    public function sellerdetail()
    {
        return $this->hasOne(User::class, 'id', 'seller_id');
    }

    public function productdetail()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
