<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pokemon extends Model
{
    
    use HasFactory;
    
    protected $table = 'pokemones';
    protected $primaryKey = 'id_pokemon';

    protected $fillable = [
        'nombre',
        'tipo',
        'region',
        'descripcion',
        'edad',
        'peso'
    ];
}
