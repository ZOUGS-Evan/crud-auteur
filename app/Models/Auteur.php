<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Auteur extends Model
{
    protected $fillable = [

        'nom',
        'prenom',
        'image',
    ];
}
