<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsType extends Model
{
    use HasFactory;
    protected $table = 'products_type';
    protected $fillable = [
        'name',
        'price',
        'years',
        'is_active',
    ];
}
