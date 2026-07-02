<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ingredient;
use App\Models\Menu;
use App\Models\MenuIngredient;
use Illuminate\Support\Facades\DB;

class IngredientSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Data Bahan Baku Berdasarkan Request User
        $ebiFuray = Ingredient::create(['nama' => 'Ebi Furay', 'stok' => 50, 'satuan' => 'pcs']);
        $eggRoll = Ingredient::create(['nama' => 'Egg Roll', 'stok' => 50, 'satuan' => 'pcs']);
        $chickenSpicy = Ingredient::create(['nama' => 'Chicken Spicy', 'stok' => 80, 'satuan' => 'porsi']);
        $chickenKatsu = Ingredient::create(['nama' => 'Chicken Katsu', 'stok' => 70, 'satuan' => 'porsi']);
        $ekkado = Ingredient::create(['nama' => 'Ekkado', 'stok' => 80, 'satuan' => 'pcs']);
        
        $strawSyrup = Ingredient::create(['nama' => 'Strawberry Syrup', 'stok' => 4000, 'satuan' => 'ml']); 
        $jasmineSyrup = Ingredient::create(['nama' => 'Jasmine Syrup', 'stok' => 2500, 'satuan' => 'ml']); 
        $lycheeSyrup = Ingredient::create(['nama' => 'Lychee Syrup', 'stok' => 1800, 'satuan' => 'ml']); 

        // Bahan general
        $ayam = Ingredient::create(['nama' => 'Daging Ayam', 'stok' => 100, 'satuan' => 'porsi']);
        $sapi = Ingredient::create(['nama' => 'Daging Sapi', 'stok' => 100, 'satuan' => 'porsi']);
        $nasi = Ingredient::create(['nama' => 'Beras/Nasi', 'stok' => 200, 'satuan' => 'porsi']);
        $teh = Ingredient::create(['nama' => 'Teh Dasar', 'stok' => 500, 'satuan' => 'gelas']);

        // Helper func
        $addRecipe = function($menuId, $ingredient, $qty) {
            MenuIngredient::create(['menu_id' => $menuId, 'ingredient_id' => $ingredient->id, 'jumlah_dibutuhkan' => $qty]);
        };

        // 2. Mapping Resep ke Menu
        $menus = Menu::all();

        foreach ($menus as $menu) {
            $namaLOWER = strtolower($menu->nama);
            
            // EXACT RECIPES BASED ON USER INPUT
            if ($namaLOWER == 'beef teriyaki a') {
                $addRecipe($menu->id, $nasi, 1);
                $addRecipe($menu->id, $sapi, 1);
                $addRecipe($menu->id, $eggRoll, 1);
                $addRecipe($menu->id, $ebiFuray, 1);
            }
            elseif ($namaLOWER == 'beef teriyaki b') {
                $addRecipe($menu->id, $nasi, 1);
                $addRecipe($menu->id, $sapi, 1);
                $addRecipe($menu->id, $eggRoll, 2);
                $addRecipe($menu->id, $ebiFuray, 1);
            }
            elseif ($namaLOWER == 'chicken katsu') {
                $addRecipe($menu->id, $nasi, 1);
                $addRecipe($menu->id, $chickenKatsu, 1); // Memakai stok spesifik Chicken Katsu
            }
            elseif ($namaLOWER == 'chicken teriyaki a') {
                $addRecipe($menu->id, $nasi, 1);
                $addRecipe($menu->id, $ayam, 1);
                $addRecipe($menu->id, $chickenSpicy, 2);
                $addRecipe($menu->id, $ekkado, 1);
            }
            elseif ($namaLOWER == 'chicken teriyaki b') {
                $addRecipe($menu->id, $nasi, 1);
                $addRecipe($menu->id, $ayam, 1);
                $addRecipe($menu->id, $chickenSpicy, 1);
                $addRecipe($menu->id, $ekkado, 1);
            }
            elseif ($namaLOWER == 'hemat a') {
                $addRecipe($menu->id, $nasi, 1);
                $addRecipe($menu->id, $eggRoll, 2);
            }
            elseif ($namaLOWER == 'mix b') {
                $addRecipe($menu->id, $nasi, 1);
                $addRecipe($menu->id, $ebiFuray, 1);
                $addRecipe($menu->id, $eggRoll, 1);
            }
            elseif ($namaLOWER == 'mix c') {
                $addRecipe($menu->id, $nasi, 1);
                $addRecipe($menu->id, $eggRoll, 2);
                $addRecipe($menu->id, $chickenSpicy, 1);
            }
            elseif ($namaLOWER == 'mix d') {
                $addRecipe($menu->id, $nasi, 1);
                $addRecipe($menu->id, $ekkado, 1);
                $addRecipe($menu->id, $chickenSpicy, 1);
                $addRecipe($menu->id, $eggRoll, 1);
            }
            elseif ($namaLOWER == 'mix e') {
                // Not specified, standard guess
                $addRecipe($menu->id, $nasi, 1);
                $addRecipe($menu->id, $ayam, 1);
            }
            
            // Toppings (Individual purchases)
            elseif ($namaLOWER == 'ebi furay') {
                $addRecipe($menu->id, $ebiFuray, 1);
            }
            elseif ($namaLOWER == 'egg roll') {
                $addRecipe($menu->id, $eggRoll, 1);
            }
            elseif ($namaLOWER == 'chicken spicy') {
                $addRecipe($menu->id, $chickenSpicy, 1);
            }
            elseif ($namaLOWER == 'ekkado') {
                $addRecipe($menu->id, $ekkado, 1);
            }
            elseif ($namaLOWER == 'extra nasi') {
                $addRecipe($menu->id, $nasi, 1);
            }
            
            // Drinks
            elseif ($namaLOWER == 'ice strawberry tea') {
                $addRecipe($menu->id, $teh, 1);
                $addRecipe($menu->id, $strawSyrup, 50); 
            }
            elseif ($namaLOWER == 'ice jasmine tea') {
                $addRecipe($menu->id, $teh, 1);
                $addRecipe($menu->id, $jasmineSyrup, 50);
            }
            elseif ($namaLOWER == 'ice lychee tea') {
                $addRecipe($menu->id, $teh, 1);
                $addRecipe($menu->id, $lycheeSyrup, 50);
            }
        }
    }
}
