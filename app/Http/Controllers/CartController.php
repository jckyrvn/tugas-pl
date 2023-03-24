<?php

namespace App\Http\Controllers;

use App\Models\buy;
use App\Models\Product;
use App\Models\tempcarts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function carts()
    {
        $user = Auth::user()->id;
        $buytotal = buy::count();
        $sum1 = tempcarts::where('user_id', $user)->sum('price');
        $data = tempcarts::where('user_id', $user)->get();
        return view ('carts')->with([
            'data' => $data,
            'buytotal' => $buytotal,
            'sum1' => $sum1
        ]);
    }

    public function cart($id)
    {
        $user = Auth::user()->id;
        $buytotal = buy::count();
        $sum1 = tempcarts::where('user_id', $user)->where('buy_id', $id)->sum('price');
        $data = tempcarts::where('user_id', $user)->where('buy_id', $id)->get();
        return view ('cart')->with([
            'data' => $data,
            'buytotal' => $buytotal,
            'sum1' => $sum1
        ]);
    }

    public function postcart(Request $request, $id)
    {
        $user = Auth::user()->id;

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
                ->route('carts')
                ->with([
                'error' => 'Oops, Try Again'
            ]);
        } else {

            $data = new tempcarts();
            $data->buy_id = $request->input('buy_id');
            $data->user_id = $user;
            $data->seller_id = $request->input('seller_id');
            $data->product_id = $id;
            $data->quantity = $request->input('quantity');
            $data->subprice = $request->input('subprice');
            $data->price = $request->input('price');

            $data->save();

            return redirect()
                ->route('carts')
                ->with([
                'success' => 'Data Added Succesfully'
            ]);
        }
    }

    public function destroycart($id)
    {
        $user = Auth::user()->id;
        $data = tempcarts::where('id', $id);

        if($data){
            $data->delete();
            return redirect()
                ->route('carts')
                ->with([
                'success' => 'Data Deleted Succesfully'
            ]);
        } else {
            return redirect()
                ->route('carts')
                ->with([
                'error' => 'Oops, Try Again'
            ]);
        }
    }
}
