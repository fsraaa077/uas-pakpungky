<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menus = [
            [ 'nama' => 'Hemat A', 'harga' => 12000, 'gambar' => 'images/hemat-a.jpg' ],
            [ 'nama' => 'Mix B', 'harga' => 13000, 'gambar' => 'images/mix-b.jpg' ],
            [ 'nama' => 'Mix C', 'harga' => 15000, 'gambar' => 'images/mix-c.jpg' ],
            [ 'nama' => 'Mix D', 'harga' => 16000, 'gambar' => 'images/mix-d.jpg' ],
            [ 'nama' => 'Mix E', 'harga' => 17000, 'gambar' => 'images/mix-e.jpg' ],
            [ 'nama' => 'Chicken Teriyaki A', 'harga' => 28000, 'gambar' => 'images/chicken-teriyaki-a.jpg' ],
            [ 'nama' => 'Chicken Katsu', 'harga' => 20000, 'gambar' => 'images/chicken-katsu.jpg' ],
            [ 'nama' => 'Beef Teriyaki A', 'harga' => 30000, 'gambar' => 'images/beef-teriyaki-a.jpg' ],
            [ 'nama' => 'Beef Teriyaki B', 'harga' => 33000, 'gambar' => 'images/beef-teriyaki-b.jpg' ],
            [ 'nama' => 'Chicken Spicy Teriyaki', 'harga' => 25000, 'gambar' => 'images/chicken-spicy-teriyaki.jpg' ],
            [ 'nama' => 'Ice Strawberry Tea', 'harga' => 8000, 'gambar' => 'images/ice-strawberry-tea.jpeg' ],
            [ 'nama' => 'Ice Lychee Tea', 'harga' => 8000, 'gambar' => 'images/ice-lychee-tea.jpeg' ],
            [ 'nama' => 'Ice Jasmine Tea', 'harga' => 5000, 'gambar' => 'images/ice-jasmine-tea.jpeg' ],
            [ 'nama' => 'Extra Nasi', 'harga' => 2000, 'gambar' => 'images/extra-nasi.jpeg' ],
            [ 'nama' => 'Egg Roll', 'harga' => 4000, 'gambar' => 'images/egg-roll.jpeg' ],
            [ 'nama' => 'Chicken Spicy', 'harga' => 5000, 'gambar' => 'images/chicken-spicy.jpeg' ],
            [ 'nama' => 'Ekkado', 'harga' => 6000, 'gambar' => 'images/Ekkado.jpeg' ],
            [ 'nama' => 'Ebi Furay', 'harga' => 6000, 'gambar' => 'images/ebi-furay.jpeg' ]
        ];

        foreach ($menus as $menu) {
            Menu::create($menu);
        }
    }
}
