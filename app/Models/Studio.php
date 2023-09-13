<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Studio extends Model
{
    use HasFactory;
    protected $fillable = [
        "name"
    ];

    public function studio_photos(){
        return $this->hasMany(StudioPhoto::class);
    }
}
