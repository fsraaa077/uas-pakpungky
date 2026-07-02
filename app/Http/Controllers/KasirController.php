<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Transaction;
use App\Models\Ingredient;
use App\Models\MenuIngredient;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class KasirController extends Controller
{
    public function index()
    {
        $allMenus = Menu::all();
        
        $utamaNames = ['Hemat A', 'Mix B', 'Mix C', 'Mix D', 'Mix E', 'Chicken Teriyaki A', 'Chicken Teriyaki B', 'Chicken Katsu', 'Beef Teriyaki A', 'Beef Teriyaki B', 'Chicken Spicy Teriyaki'];
        $minumanNames = ['Ice Strawberry Tea', 'Ice Lychee Tea', 'Ice Jasmine Tea'];
        
        $utama = [];
        $topping = [];
        $minuman = [];

        foreach ($allMenus as $menu) {
            if (in_array($menu->nama, $utamaNames)) {
                $utama[] = $menu;
            } elseif (in_array($menu->nama, $minumanNames)) {
                $minuman[] = $menu;
            } else {
                $topping[] = $menu;
            }
        }

        $ingredients = Ingredient::all();

        return response()->json([
            'success' => true,
            'data' => compact('utama', 'topping', 'minuman', 'ingredients')
        ]);
    }

    public function checkout(Request $request)
    {
        $cart = $request->input('cart');
        $customerName = $request->input('customerName');
        
        if (empty($customerName)) {
            return response()->json(['success' => false, 'message' => 'Nama pelanggan harus diisi!']);
        }

        if (empty($cart)) {
            return response()->json(['success' => false, 'message' => 'Keranjang kosong!']);
        }

        DB::beginTransaction();
        try {
            $tanggal = Carbon::now()->format('d/m/Y');

            // 1. Hitung total kebutuhan bahan baku
            $ingredientsDibutuhkan = [];
            foreach ($cart as $item) {
                $menu = Menu::where('nama', $item['nama'])->first();
                if ($menu) {
                    $menuIngredients = MenuIngredient::where('menu_id', $menu->id)->get();
                    foreach ($menuIngredients as $mi) {
                        if (!isset($ingredientsDibutuhkan[$mi->ingredient_id])) {
                            $ingredientsDibutuhkan[$mi->ingredient_id] = 0;
                        }
                        $ingredientsDibutuhkan[$mi->ingredient_id] += ($mi->jumlah_dibutuhkan * $item['jumlah']);
                    }
                }
            }

            // 2. Validasi ketersediaan stok
            foreach ($ingredientsDibutuhkan as $ingredientId => $qtyRequired) {
                $ingredient = Ingredient::find($ingredientId);
                if ($ingredient->stok < $qtyRequired) {
                    DB::rollBack();
                    return response()->json([
                        'success' => false, 
                        'message' => "Stok {$ingredient->nama} tidak mencukupi! (Butuh: $qtyRequired, Sisa: {$ingredient->stok})"
                    ]);
                }
            }

            // 3. Potong Stok Gudang
            foreach ($ingredientsDibutuhkan as $ingredientId => $qtyRequired) {
                $ingredient = Ingredient::find($ingredientId);
                $ingredient->stok -= $qtyRequired;
                $ingredient->save();
            }

            // 4. Simpan Transaksi
            $receiptNo = 'TRX-' . Carbon::now()->format('YmdHis') . '-' . rand(100, 999);
            foreach ($cart as $item) {
                Transaction::create([
                    'receipt_no' => $receiptNo,
                    'customer_name' => $customerName,
                    'tanggal' => $tanggal,
                    'menu' => $item['nama'],
                    'jumlah' => $item['jumlah'],
                    'harga' => $item['harga'],
                    'total' => $item['harga'] * $item['jumlah']
                ]);
            }

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Transaksi berhasil disimpan! Stok telah terpotong.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan sistem: ' . $e->getMessage()]);
        }
    }

    public function restock(Request $request)
    {
        $id = $request->input('id');
        $qty = $request->input('qty');
        $password = $request->input('password');

        if ($password !== 'koben123') {
            return response()->json(['success' => false, 'message' => 'Password salah!']);
        }

        $ing = Ingredient::find($id);
        if ($ing) {
            $ing->stok += $qty;
            $ing->save();
            return response()->json(['success' => true, 'message' => "Stok {$ing->nama} berhasil ditambah sebanyak {$qty} {$ing->satuan}."]);
        }
        return response()->json(['success' => false, 'message' => 'Item tidak ditemukan!']);
    }
    public function history(Request $request)
    {
        $date = $request->input('date'); // YYYY-MM-DD
        if (!$date) {
            $date = Carbon::now()->format('Y-m-d');
        }
        
        $tanggalFormatId = Carbon::parse($date)->format('d/m/Y');
        
        $transactions = Transaction::where('tanggal', $tanggalFormatId)
                                   ->orderBy('created_at', 'desc')
                                   ->get();
                                   
        $grouped = $transactions->groupBy('receipt_no')->map(function ($items, $receiptNo) {
            $first = $items->first();
            return [
                'receipt_no' => $receiptNo,
                'customer_name' => $first->customer_name,
                'time' => $first->created_at->format('H:i'),
                'total_harga' => $items->sum('total'),
                'items' => $items->map(function ($item) {
                    return [
                        'menu' => $item->menu,
                        'jumlah' => $item->jumlah,
                        'harga' => $item->harga,
                        'total' => $item->total
                    ];
                })
            ];
        })->values();

        return response()->json(['success' => true, 'data' => $grouped]);
    }
}
