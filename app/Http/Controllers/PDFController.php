<?php

namespace App\Http\Controllers;

use App\Models\buy;
use App\Models\buydetail;
use Illuminate\Http\Request;
use PDF;

class PDFController extends Controller
{
    public function home($id){

        $data1 = buydetail::where('buy_id', $id)->with('productdetail')->get();
        $data2 = buy::where('id', $id)->with('userdetail')->get();
        $data3 = buydetail::where('buy_id', $id)->with('sellerdetail')->first();
        // return $data3;
        // return view('pdf.home')->with([
        //     'data1' => $data1,
        //     'data2' => $data2,
        //     'data3' => $data3,
        // ]);

        view()->share([
            'data1' => $data1,
            'data2' => $data2,
            'data3' => $data3,
        ]);
        $pdf = PDF::loadview('pdf.home');
        return $pdf->download('invoice.pdf');
    }

    public function exportpdf(){
        
    }
}
