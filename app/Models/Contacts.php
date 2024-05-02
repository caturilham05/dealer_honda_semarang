<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contacts extends Model
{
    use HasFactory;

    protected $table = 'contact';
    protected $fillable = [
        'whatsapp_number',
        'address',
        'social_media',
        'description',
        'is_active',
    ];
}
