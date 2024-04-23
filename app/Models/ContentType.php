<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentType extends Model
{
    use HasFactory;
    protected $table    = 'content_type';
    protected $fillable = [
        'title',
        'is_active',
        'created_by',
        'created_by_name',
        'modifed'
    ];
}
