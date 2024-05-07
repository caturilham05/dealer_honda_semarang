<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $fillable = [
        'product_type_id',
        'promo_id',
        'name',
        'price',
        'specification',
        'special_feature',
        'description',
        'image',
        'images',
        'brochure',
        'is_active'
    ];

    protected $casts = [
        'images'   => 'array',
        'brochure' => 'array'
    ];

    public function product_type()
    {
        return $this->hasOne(ProductsType::class, 'id', 'product_type_id');
    }

    public function promo()
    {
        return $this->hasOne(Promo::class, 'id', 'promo_id');
    }

    public function products_installments()
    {
        return $this->hasMany(Products_installments::class, 'product_id');
    }
}
