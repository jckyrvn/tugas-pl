<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

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
            'subprice'=>'required',
            'discount'=>'required',
            'price'=>'max:100',
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
            'price'=>'max:100',
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
                ->route('seller.home')
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
}
