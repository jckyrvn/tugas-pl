<?php

namespace App\Http\Controllers;

use App\Models\buy;
use App\Models\Product;
use App\Models\buydetail;
use App\Models\tempcarts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BuyController extends Controller
{
    public function postbuy(Request $request, $id){
        $user = Auth::user()->id;
        $data3 = tempcarts::where('buy_id', $id)->first();
        $sellerid = $data3->seller_id;

        $sum1 = tempcarts::where('user_id', $user)->sum('price');
        $dataall = tempcarts::where('buy_id', $id)->get();
        

        $validator = Validator::make($request->all(), [
            'buy_id'=>'required',
            'user_id'=>'required',
            'seller_id'=>'required',
            'product_id'=>'required',
            'quantity'=>'required',
            'subprice'=>'required',
            'price'=>'required',
        ]);

        if($validator->fails())
        {
            return redirect()
                ->route('cart')
                ->with([
                'error' => 'Oops, Try Again'
            ]);
        } else {
            buy::create([
                'id' => $id,
                'user_id' => $user,
                'seller_id' => $sellerid,
                'totalprice' => $sum1
            ]);

            foreach ($dataall as $data){
                buydetail::create([
                    'buy_id' => $data->buy_id,
                    'product_id' => $data->product_id,
                    'seller_id' => $data->seller_id,
                    'quantity' => $data->quantity,
                    'subprice' => $data->subprice,
                    'price' => $data->price,
                ]);

                $product = Product::where('id', $data->product_id)->first();
                $product->update([
                    'stock' => $product->stock - $data->quantity
                ]);

                $data->delete();
            }

            return redirect()
                ->route('home')
                ->with([
                'success' => 'Data Ordered Succesfully'
            ]);
        }
    }
}
