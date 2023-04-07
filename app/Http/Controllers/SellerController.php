<?php

namespace App\Http\Controllers;

use App\Models\buy;
use App\Models\User;
use App\Models\Product;
use App\Models\buydetail;
use App\Models\tempmerchant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class SellerController extends Controller
{
    public function index()
    {
        return view ('seller.home');
    }

    public function postproduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name_product'=>'max:255',
            'description'=>'',
            'subprice'=>'',
            'discount'=>'',
            'price'=>'required|max:100',
            'seller_id'=>'max:255',
            'media'=>'image|mimes:jpeg,png,jpg',
            'stock'=>'max:255',
        ]);

        if($validator->fails())
        {
            return redirect()
                ->route('seller.home')
                ->with([
                'error' => 'Oops, Try Again'
            ]);
        } else {

            $data = new Product;
            $data->name_product = $request->input('name_product');
            $data->description = $request->input('description');
            $data->subprice = $request->input('subprice');
            $data->discount = $request->input('discount');
            $data->price = $request->input('price');
            $data->seller_id = $request->input('seller_id');
            $data->stock = $request->input('stock');

            if($request->hasFile('media'))
            {
                $file = $request->file('media');
                $namaFile = time().rand(100,999).".".$file->getClientOriginalExtension();
                $file->move(public_path().'/productimg', $namaFile);
                $data->media = $namaFile;
            }
            $data->save();

            return redirect()
                ->route('seller.home')
                ->with([
                'success' => 'Data Inputed Succesfully'
            ]);
        }
    }

    public function editproduct($id)
    {
        $data = Product::find($id);
        return view('seller.edit')->with([
            'data' => $data
        ]);
    }

    public function updateproduct(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name_product'=>'max:255',
            'description'=>'',
            'subprice'=>'',
            'discount'=>'',
            'price'=>'required|max:100',
            'seller_id'=>'max:255',
            'media'=>'image|mimes:jpeg,png,jpg',
            'stock'=>'max:255',
        ]);

        if($validator->fails())
        {
            return redirect()
                ->route('seller.home')
                ->with([
                'error' => 'Oops, Try Again'
            ]);
        } else {

            $data = Product::find($id);
            if($data){
                $data->name_product = $request->input('name_product');
                $data->description = $request->input('description');
                $data->subprice = $request->input('subprice');
                $data->discount = $request->input('discount');
                $data->price = $request->input('price');
                $data->seller_id = $request->input('seller_id');
                $data->stock = $request->input('stock');

                if($request->hasFile('media'))
                {
                    $path = 'img/'.$data->media;
                    if(File::exists($path))
                    {
                        File::delete($path);
                    }

                    $file = $request->file('media');
                    $namaFile = time().rand(100,999).".".$file->getClientOriginalExtension();
                    $file->move(public_path().'/productimg', $namaFile);
                    $data->media = $namaFile;
                }
                $data->save();

                return redirect()
                    ->route('seller.home')
                    ->with([
                    'success' => 'Data Updated Succesfully'
                ]);
            } else {
                return redirect()
                ->route('seller.home')
                ->with([
                'error' => 'Oops, Try Again'
            ]);
            }
        }
    }

    public function destroyproduct($id)
    {
        $data = Product::find($id);
        if($data){
            $path = 'img/'.$data->media;
            if(File::exists($path)){
                File::delete($path);
            }
            
            $data->delete();
            return redirect()
                ->route('seller')
                ->with([
                'success' => 'Data Deleted Succesfully'
            ]);
        } else {
            return redirect()
                ->route('seller.home')
                ->with([
                'error' => 'Oops, Try Again'
            ]);
        }
    }

    public function becomeseller()
    {
        return view ('seller.signup');
    }

    public function signupseller(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'seller_id'=>'required',
            'merchant_address'=>'required',
        ]);

        if($validator->fails())
        {
            return redirect()
                ->route('home')
                ->with([
                'error' => 'Oops, Try Again'
            ]);
        } else {

            $data = new tempmerchant;
            $data->seller_id = $id;
            $data->merchant_address = $request->merchant_address;
            $data->save();

            return redirect()
                ->route('home')
                ->with([
                'success' => 'Data Inputed Succesfully'
            ]);
        }
    }

    public function orders(){
        $seller = Auth::user()->id;
        $dataall = buy::where('seller_id', $seller)->with('buydetail')->get();

        return view ('seller.orders')->with([
            'dataall' => $dataall
        ]);
    }

    public function editorders($id){
        $userid = Auth::user()->id;
        $user = User::find($userid);
        $dataall2 = buy::where('id', $id)->first();
        $dataall = buydetail::where('buy_id', $id)->with('productdetail')->get();

        return view ('seller.editorders')->with([
            'dataall2' => $dataall2,
            'dataall' => $dataall,
            'user' => $user,
        ]);
    }

    public function updateorders(Request $request, $id){
        $data = buy::find($id);

        if($data){
            $data->status = 'Shipping Order';
            $data->save();

            return redirect()
                ->route('home')
                ->with([
                'success' => 'Data Updated Succesfully'
            ]);
        } else {
            return redirect()
                ->route('home')
                ->with([
                'error' => 'Oops, Try Again'
            ]);
        }
    }
}
