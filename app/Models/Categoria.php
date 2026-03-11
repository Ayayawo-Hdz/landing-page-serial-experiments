<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categorias';

    protected $fillable = [
        'name',
        'description'
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'categoria_id');
    }
}
