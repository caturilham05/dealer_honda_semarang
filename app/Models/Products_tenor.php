<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products_tenor extends Model
{
    use HasFactory;

    protected $table    = 'products_tenor';
    protected $fillable = [
        'product_id',
        'tenor_id'
    ];
}
