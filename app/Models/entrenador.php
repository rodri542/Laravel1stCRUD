<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class entrenador extends Model
{
    use HasFactory;
    
    protected $table = 'entrenadors';
    protected $primaryKey = 'id_entrenador';

    protected $fillable = [
        'nombreEn',
        'edad',
        'ciudad',
    ];
}
