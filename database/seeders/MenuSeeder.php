<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $links = [
            [
                'name'      => 'Beranda',
                'route'     => 'admin.dashboard',
                'prefix'    => 'dashboard',
                'ordering'  => 1,
                'is_admin'  => 2,
                'is_active' => 1,
            ],
            [
                'name'      => 'Produk',
                'route'     => 'admin.products',
                'prefix'    => 'products',
                'ordering'  => 2,
                'is_admin'  => 2,
                'is_active' => 1,
            ],
            [
                'name'      => 'Pengguna',
                'route'     => 'admin.user',
                'prefix'    => 'user',
                'ordering'  => 3,
                'is_admin'  => 1,
                'is_active' => 1,
            ],
            [
                'name'      => 'Simulasi Kredit',
                'route'     => 'admin.credit',
                'prefix'    => 'credit',
                'ordering'  => 4,
                'is_admin'  => 0,
                'is_active' => 1,
            ],
            [
                'name'      => 'Pengaturan',
                'route'     => 'admin.settings',
                'prefix'    => 'settings',
                'ordering'  => 5,
                'is_admin'  => 1,
                'is_active' => 1,
            ],
            [
                'name'      => 'Pengaturan Menu',
                'route'     => 'admin.navbars',
                'prefix'    => 'navbars',
                'ordering'  => 6,
                'is_admin'  => 1,
                'is_active' => 1,
            ],
        ];
  
        foreach ($links as $key => $navbar) {
            Menu::create($navbar);
        }
    }
}
