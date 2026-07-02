<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuIngredient extends Model
{
    use HasFactory;

    protected $fillable = ['menu_id', 'ingredient_id', 'jumlah_dibutuhkan'];
}
