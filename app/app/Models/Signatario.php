<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Signatario extends Model
{
    protected $fillable = [
        'nome',
        'email',
        'cargo',
    ];

    use HasFactory;
}
