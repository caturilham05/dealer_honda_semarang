<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $table = 'menu';
    protected $fillable = [
        'par_id',
        'name',
        'route',
        'prefix',
        'ordering',
        'is_admin',
        'is_active'
    ];

    public function sub_menu()
    {
        return $this->hasMany(Menu::class, 'par_id');
    }
}
