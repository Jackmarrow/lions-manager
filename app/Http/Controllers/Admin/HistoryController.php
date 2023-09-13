<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\HistoryMail;
use App\Models\ResvClasse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HistoryController extends Controller
{
    public function index(){
        $reservations = ResvClasse::all();
        return view('admin.backend.history', compact('reservations'));
    }

    public function store(){

        $reservations = ResvClasse::all();
        //Email Body
        $historyMailData = [
            'body' => $reservations,
        ];

        // dd($historyMailData['body']);
        Mail::to('jackmarrow06@gmail.com')->send(new HistoryMail($historyMailData));

        return back();
    }
}
