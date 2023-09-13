<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResvClasseController extends Controller
{
    public function index(){
        return view('user.pages.gestion_classe.reservation_classe');
    }
}
