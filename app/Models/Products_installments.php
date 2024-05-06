<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products_installments extends Model
{
    use HasFactory;

    protected $table    = 'products_installments';
    protected $fillable = [
        'product_id',
        'tenor_id',
        'price_installment',
        'tdp'
    ];

    public function tenor()
    {
        return $this->hasOne(Tenor::class, 'id', 'tenor_id');
    }
}
