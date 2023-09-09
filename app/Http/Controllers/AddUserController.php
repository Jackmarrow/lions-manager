<?php

namespace App\Http\Controllers;

use App\Mail\DemoMail;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AddUserController extends Controller
{
    public function index(){
        return view('admin.pages.register');
    }

    public function store(Request $request){
        $request->validate([
            'name' => ['required'],
            'email' => ['required'],
        ]);

        //Random Password
        $password = Str::random(8);

        //Email Body
        $mailData = [
            'email'=> $request->email,
            'password'=> $password
        ];

        Mail::to('antonatic345@gmail.com')->send(new DemoMail($mailData));


        // Create User Info
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($password),
        ]);

        event(new Registered($user));

        return redirect()->back();
    }
}
