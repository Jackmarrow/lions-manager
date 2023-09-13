<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudioPhoto extends Model
{
    use HasFactory;

    use HasFactory;
    protected $fillable = [
        "photo",
        "studio_id",
    ];

    public function studio(){
        return $this->belongsTo(Studio::class);
    }
}
