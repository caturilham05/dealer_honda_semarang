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
        'url_google_maps',
        'text_message',
        'is_active',
    ];
}
