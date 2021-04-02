<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom', 'prenom', 'email', 'date_naissance', 'lieu_naissance', 'code_cne', 'code_cin', 'gender', 'filier', 'annee'
    ];
}
