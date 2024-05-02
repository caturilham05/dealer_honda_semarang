<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagesCategory extends Model
{
    use HasFactory;

    protected $table    = 'imageslider_category';
    protected $fillable = [
        'name',
        'is_active',
    ];
}
