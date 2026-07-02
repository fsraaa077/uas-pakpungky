<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['receipt_no', 'customer_name', 'tanggal', 'menu', 'jumlah', 'harga', 'total'];
}
