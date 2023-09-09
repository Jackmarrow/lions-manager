<?php

namespace App\Http\Controllers;

use App\Mail\DemoMail;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;

class AddUserController extends Controller
{
    public function index(){
        $roles = Role::all();
        return view('admin.pages.register', compact('roles'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => ['required'],
            'email' => ['required'],
            'type' => ['required'],
        ]);

        //Random Password
        $password = Str::random(8);

        //Email Body
        $mailData = [
            'email'=> $request->email,
            'password'=> $password
        ];

        Mail::to('antonatic345@gmail.com')->send(new DemoMail($mailData));

        // Retreive the last user id
        $userId = User::latest()->first()->id;
        // Retreive all the selected role
        $roles = $request->input('role');

        // If no role has been selected
        if($roles == null){
            $userData = [
                'role_id'=> 4,
                'user_id'=>$userId,
            ];
            UserRole::create($userData);
        }

        // If Multiple or one role has been selected
        else{
        // Loop through all selected role
        foreach ($roles as $role) {
            $userData = [
                'role_id'=>$role,
                'user_id'=>$userId,
            ];
            UserRole::create($userData);
        }
        }


        // Create User Info
        $user = User::create([
            'name' => $request->name,
            'type' => $request->type,
            'email' => $request->email,
            'password' => Hash::make($password),
        ]);

        // assign roles
        // Loop through all selected role
        foreach ($roles as $role) {
            $user->assignRole($role);
        }
        // 

        event(new Registered($user));

        return redirect()->back();
    }
}
