<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\ClassePhoto;
use App\Models\Studio;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    
    public function lionsGeekClass(){
        $classes = Classe::all();
        $classe_photos = ClassePhoto::all();
        return view('user.pages.gestion_classe.lionsgeek_classe', compact('classes','classe_photos'));
    }

    public function lionsGeekStudio(){
        $studios = Studio::all();
        return view('user.pages.gestion_studio.lionsgeek_studio', compact('studios'));
    }
}
