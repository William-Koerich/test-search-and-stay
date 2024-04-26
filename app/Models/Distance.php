<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distance extends Model
{
    use HasFactory;

    protected $table = 'distances';

    protected $fillable = [
        'cep_origem',
        'cep_destino',
        'distancia'
    ];

    // Se você precisar de mais funcionalidades, como métodos personalizados ou
    // relações, você pode adicioná-las aqui.
}
