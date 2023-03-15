<?php

namespace App\Http\Controllers;

use App\Models\tempmerchant;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $data = tempmerchant::with('user')->get();
        return view ('admin.home')->with([
            'data' => $data
        ]);
    }

    public function approve($id)
    {
        $data = tempmerchant::where('seller_id',$id)->get();
        $data1 = tempmerchant::where('seller_id',$id);
        
        foreach ($data as $item){
        $datauser = User::where('id', $item->seller_id);
        $datauser->update([
            'isSeller' => 1,
            'merchant_address' => $item->merchant_address,
        ]);

        $data1->delete();

        return redirect()
                ->route('admin.home')
                ->with([
                'success' => 'Seller Approve Succesfully'
            ]);
        }
    }

    public function reject($id){
        $data = tempmerchant::where('seller_id',$id);
        if($data){
            $data->delete();
            return redirect()
                ->route('admin.home')
                ->with([
                'success' => 'Seller Rejected Succesfully'
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
