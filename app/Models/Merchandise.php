<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Merchandise extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'category',
        'stock',
        'status',
        'sizes',
        'colors'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'stock' => 'integer'
    ];
}
