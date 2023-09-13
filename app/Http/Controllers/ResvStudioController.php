<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResvStudioController extends Controller
{
    public function index(){
        return view('user.pages.gestion_studio.reservation_studio');
    }
}
