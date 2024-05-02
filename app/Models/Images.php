<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    use HasFactory;

    protected $table = 'imageslider';
    protected $fillable = [
        'cat_id',
        'image',
        'images',
        'is_active',
    ];

    protected $casts = [
        'images' => 'array'
    ];

    public function imageslider_category()
    {
        return $this->hasOne(ImagesCategory::class, 'id', 'cat_id');
    }
}
