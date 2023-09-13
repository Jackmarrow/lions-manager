<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function photos()
    {
        return $this->hasMany(ClassePhoto::class);
    }

    //Resv_classes & classes => One to Many 
    public function reservations()
    {
        return $this->hasMany(ResvClasse::class);
    }
}
