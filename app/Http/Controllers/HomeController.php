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
    public function search(Request $request){
        $search = $request->input('search');
    
        // Search in the title and body columns from the posts table
        $posts = Product::query()
            ->where('name_product', 'LIKE', "%{$search}%")
            ->orWhere('description', 'LIKE', "%{$search}%")
            ->get();
    
        // Return the search view with the resluts compacted
        return view('home', [
            'product'=> $posts,
        ]); 
    }
}
