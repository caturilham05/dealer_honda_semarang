<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    use HasFactory;
    protected $table = 'promo';
    protected $fillable = [
        'name',
        'price',
        'description',
        'image',
        'images',
        'is_active'
    ];
    protected $casts = [
        'images' => 'array'
    ];
}
