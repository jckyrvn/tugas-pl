<?php

namespace App\Models;

use App\Models\User;
use App\Models\buydetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class buy extends Model
{
    protected $table = 'buy';
    public $incrementing = false;
    protected $fillable = [
        'id',
        'user_id',
        'seller_id',
        'totalprice',
        'status',
    ];
    
    public function userdetail()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function buydetail()
    {
        return $this->hasMany(buydetail::class, 'buy_id', 'id');
    }

    public function history()
    {
        return $this->hasMany(buydetail::class, 'buy_id', 'id');
    }

}
