<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResvClasse extends Model
{
    use HasFactory;

    protected $fillable = [
        'classe_id',
        'user_id',
        'start',
        'end',
        'resv_etat'
    ];

    //^resv_classes & classes => One to Many 
    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }

    //^resv_classes & users => One to Many 
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
