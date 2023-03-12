<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FavoriteController extends Controller
{
    public function favorite()
    {
        return view('favorite');
    }

    public function postfavorite($id)
    {
        $user = Auth::user()->id;
        $checkfavorite = Favorite::where('product_id', $id)->where('user_id', $user)->first();

        if($checkfavorite!=null){
            return redirect()
                    ->route('favorite')
                    ->with([
                    'error' => 'Already Set To Favorite'
            ]);
        } else {    
            $favorite = new Favorite;

            $favorite->user_id = $user;
            $favorite->product_id = $id;
            // dd($favorite);
            $favorite->save();
            
            return redirect()
                    ->route('favorite')
                    ->with([
                    'success' => 'Add to Favorite Succesfully'
            ]);
        }
    }

    public function destroyfavorite($id)
    {
        $user = Auth::user()->id;
        $checkfavorite = Favorite::where('product_id', $id)->where('user_id', $user)->first();

        if($checkfavorite!=null){
            $checkfavorite->delete();
            return redirect()
                ->route('favorite')
                ->with([
                'success' => 'Data Deleted Succesfully'
            ]);
        } else {
            return redirect()
                ->route('favorite')
                ->with([
                'error' => 'Oops, Try Again'
            ]);
        }
    }
}
