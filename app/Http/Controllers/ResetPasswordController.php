<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResetPasswordController extends Controller
{
    public function index(){
        return view('reset-password');
    }

    public function update(Request $request){
        request()->validate([
            'new_password'=>['required'],
            'confirm_password'=>['required'],
        ]);

        $user_id = Auth::user()->id;

        $user = User::where('id',$user_id)->first();

        if($request->new_password == $request->confirm_password){
            $user->update([
                'password'=>$request->new_password,
                'password_update'=> 1
            ]);

            return redirect()->route('user.index');
        }   

        else{
            return back()->with('error', 'The password is not the same');;
        }
    }
}
