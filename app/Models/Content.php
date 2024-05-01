<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;
    protected $table = 'content';
    protected $fillable = [
        'content_type_id',
        'title',
        'description',
        'keyword',
        'tags',
        'intro',
        'content',
        'image',
        'images',
        'is_active',
        'created_by',
        'created_by_name',
        'modified'
    ];

    protected $casts = [
        'images' => 'array'
    ];

    public function content_type()
    {
        return $this->hasOne(ContentType::class, 'id', 'content_type_id');
    }
}
