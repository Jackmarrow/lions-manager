<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
    public function index()
    {
        $roles = Role::all();
        $users = User::all();
        return view('admin.pages.register', compact('roles', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required'],
            'type' => ['required'],
        ]);

        //Random Password
        $password = Str::random(8);

        //Email Body
        $mailData = [
            'email' => $request->email,
            'password' => $password
        ];

        Mail::to($request->email)->send(new DemoMail($mailData));


        $roles = $request->input('role');

        // Create User
        $user = User::create([
            'name' => $request->name,
            'type' => $request->type,
            'email' => $request->email,
            'password' => Hash::make($password),
        ]);

        // If no role has been selected
        if ($roles == null) {
            $user->assignRole('none');
        }

        // If Multiple or one role has been selected
        else {
            // Loop through all selected role
            foreach ($roles as $role) {
                // assign roles
                $user->assignRole($role);
            }
        }

        // 
        event(new Registered($user));

        return redirect()->back();
    }


    public function update(Request $request, User $user){
        request()->validate([
            'name'=>['required'],
            'email'=>['required'],
            'type'=>['required'],
        ]);

        // $user = auth()->user;

        $user->update([
            'name'=> $request->name,
            'email'=> $request->email,
            'type'=> $request->type,
        ]);

        return back();
    }

    public function destroy(User $user){

        $user->delete();

        return back();
    }
}
