<?php

namespace App\Http\Controllers;

use App\Models\buy;
use App\Models\buydetail;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(){
        return view('auth.login');
    }
    public function show(){
        return view('auth.register');
    }

    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            "name"=>"required|unique:users|min:3",
            "email"=>"required|email|unique:users",
            "password"=>"required|min:8",
        ]);
        if($validator->fails()){
            return back()->withErrors(["message"=>"Registrasi Anda gagal!"]);
        }
        $created = User::create(array_merge($validator->validated(), ["password"=> Hash::make($request->password)]));
        return redirect()->route('auth.login');
    }

    public function login(Request $request){

        $validator = Validator::make($request->all(), [
            "email"=>"required|email",
            "password"=>"required|min:8",
        ]);
        
        if($validator->fails()){
            return back()->withErrors(["message"=>"Login Anda Gagal"]);
        }
        $user = User::where('email', $request->email)->first();
        if($user == null){
            return back()->withErrors(["message"=>"User Tidak ditemukan"]);
        }
        if(Auth::attempt($request->only('email', 'password'))){
            $request->session()->regenerate();
            return redirect()->route('home');
        }
    }
    public function logout(){
            Auth::logout();

            request()->session()->invalidate();
     
            request()->session()->regenerateToken();
    
            return redirect()->route('auth.login');
    }


    public function showProfile(){
        $userid = Auth::user()->id;
        $user = User::find($userid);
        $dataall = buy::where('user_id', $userid)->with('history')->get();

        return view ('pages/profile')->with([
            'dataall' => $dataall,
            'user' => $user,
        ]);
    }
    // public function editProfile($id){
    //     return view('pages/editprofile');
    // }
    public function showSeller($id){
        $product_seller_all = User::with(['product'])->where('id', $id)->first();
        return view('pages/centre', [
            'id' => $id,
            'product_seller_all' => $product_seller_all,
        ]);
    }
    public function create(){
    
    }

    public function editProfile($id){
        $cekuser = User::find($id);

        if($cekuser!=null){            
            return view('pages/editprofile', [
                'cekuser' => $cekuser,
            ]);
        } else {    
            return redirect()
                    ->route('home')
                    ->with([
                    'error' => 'Not Found'
            ]);
        }
    }

    public function updateProfile(Request $request){
        $userid = Auth::user()->id;

        $validator = Validator::make($request->all(), [
            'name'=>'required',
            'email'=>'required',
            'address'=>'',
            'merchant_address'=>'',
            'number'=>'',
            'profile'=>'image|mimes:jpeg,png,jpg'
        ]);

        if($validator->fails())
        {
            return redirect()
                ->route('home')
                ->with([
                'error' => $validator->messages()
            ]);
        } else {
            $data = User::find($userid);
            if($data){
                $data->name = $request->input('name');
                $data->email = $request->input('email');
                $data->address = $request->input('address');
                $data->merchant_address = $request->input('merchant_address');
                $data->number = $request->input('number');

                if($request->hasFile('profile'))
                {
                    $path = 'img/'.$data->profile;
                    if(File::exists($path))
                    {
                        File::delete($path);
                    }

                    $file = $request->file('profile');
                    $namaFile = time().rand(100,999).".".$file->getClientOriginalExtension();
                    $file->move(public_path().'/profileimg', $namaFile);
                    $data->profile = $namaFile;
                }
                $data->save();
    
                return redirect()
                    ->route('home');
            } else {
                return redirect()
                ->route('home')
                ->with([
                'error' => 'Data Updated Succesfully'
            ]);
            }
        }
    }

    public function history($id){
        $userid = Auth::user()->id;
        $user = User::find($userid);
        $dataall2 = buy::where('id', $id)->first();
        $dataall = buydetail::where('buy_id', $id)->with('productdetail')->get();

        // return $dataall;

        return view ('history')->with([
            'dataall2' => $dataall2,
            'dataall' => $dataall,
            'user' => $user,
        ]);
    }

    public function updatehistory($id){
        $data = buy::find($id);

        if($data){
            $data->status = 'Order Received';
            $data->save();

            return redirect()
                ->route('home')
                ->with([
                'success' => 'Data Updated Successfully'
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
