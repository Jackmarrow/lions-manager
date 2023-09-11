<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){
        $users = User::all();

        // if(auth()->user()->password_update == 1){
        //     return view('user.index', compact('users'));
        // } else{
        //     return view('reset-password');
        // }

        return view('user.index', compact('users'));
    }
}
