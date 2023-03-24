<?php

namespace App\Http\Controllers;

use App\Models\buy;
use App\Models\Product;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function detail($id)
    {
        $buytotal = buy::count();
        $data = Product::find($id);
        return view('detail')->with([
            'data' => $data,
            'buytotal' => $buytotal
        ]);
    }
}
