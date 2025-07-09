<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Processo extends Model
{
    protected $fillable = [
        'titulo',
        'descricao',
        'status',
        'documento' 
    ];

    use HasFactory;
}
