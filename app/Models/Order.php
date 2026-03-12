<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
    'nombre_titular',
    'numero_tarjeta',
    'fecha_expiracion',
    'cvv',
    'total'
];
}
