<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index(){
        $product = Product::all();
        return view('home', [
            'product'=>$product,
        ]);
    }
}
