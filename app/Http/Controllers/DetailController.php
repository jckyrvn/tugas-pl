<?php

namespace App\Http\Controllers;

use App\Models\buy;
use App\Models\Product;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function detail($id)
    {
        $product = Product::find($id);
        $sellerid = $product->seller_id;
        $buytotal = buy::where('seller_id', $sellerid)->count();
        $data = Product::find($id);

        return view('detail')->with([
            'data' => $data,
            'buytotal' => $buytotal
        ]);
    }
}
