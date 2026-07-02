<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Koben Kasir - POS System</title>
  <style>
    :root {
      --primary-color: #2c4a85;
      --bg-color: #f0f2f5;
      --card-bg: #ffffff;
      --text-dark: #333333;
      --text-muted: #777777;
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: var(--bg-color);
      color: var(--text-dark);
      display: flex;
      height: 100vh;
      overflow: hidden;
    }

    /* Kiri: Gabungan Menu Area */
    .menu-area {
      flex: 6.5; 
      display: flex;
      background: #e9ecef;
    }

    .grid-container {
      flex: 1;
      padding: 20px;
      overflow-y: auto;
    }
    
    .section-title {
      font-size: 18px;
      font-weight: 700;
      color: var(--primary-color);
      margin-bottom: 15px;
      border-bottom: 2px solid var(--primary-color);
      display: inline-block;
      padding-bottom: 5px;
    }

    .main-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 15px;
      align-content: start;
    }

    .menu-card {
      background: var(--card-bg);
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 2px 4px rgba(0,0,0,0.05);
      cursor: pointer;
      transition: transform 0.1s ease, box-shadow 0.1s ease;
      display: flex;
      flex-direction: column;
      height: 100%;
    }

    .menu-card:active {
      transform: scale(0.97);
    }

    .menu-card img {
      width: 100%;
      height: 100px;
      object-fit: cover;
    }
    
    .menu-card-body {
      padding: 10px;
      text-align: center;
      flex: 1;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .menu-card h3 {
      font-size: 13px;
      font-weight: 600;
      margin-bottom: 3px;
      color: var(--text-dark);
    }

    .menu-card p {
      font-size: 12px;
      color: var(--text-muted);
    }

    /* Tengah: Category Sidebar (Sesuai Sketsa) */
    .category-sidebar {
      width: 110px;
      background: white;
      border-left: 1px solid #ddd;
      border-right: 1px solid #ddd;
      padding: 20px 10px;
      display: flex;
      flex-direction: column;
      gap: 15px;
      box-shadow: -2px 0 5px rgba(0,0,0,0.02);
      z-index: 5;
    }

    .cat-btn {
      background: #f8f9fa;
      border: 2px solid #e0e0e0;
      border-radius: 10px;
      padding: 15px 5px;
      text-align: center;
      cursor: pointer;
      transition: all 0.2s;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }

    .cat-btn:hover {
      border-color: #a3b1d2;
      background: #f0f4ff;
    }

    .cat-btn.active {
      background: var(--primary-color);
      color: white;
      border-color: var(--primary-color);
    }

    .cat-icon {
      margin-bottom: 5px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .cat-text {
      font-size: 11px;
      font-weight: 700;
    }
    
    /* GUDANG GRID */
    .gudang-card {
      background: white;
      border: 1px solid #ddd;
      border-radius: 8px;
      padding: 15px;
      text-align: center;
      box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }
    .gudang-card h3 {
      font-size: 14px;
      color: var(--primary-color);
      margin-bottom: 10px;
    }
    .gudang-card .stok-angka {
      font-size: 24px;
      font-weight: bold;
      color: #28a745;
    }
    .gudang-card .stok-satuan {
      font-size: 12px;
      color: #777;
    }

    /* Kanan: Billing Area */
    .billing-area {
      flex: 3.5;
      background: var(--card-bg);
      display: flex;
      flex-direction: column;
      box-shadow: -4px 0 15px rgba(0,0,0,0.05);
      z-index: 10;
    }

    .billing-header {
      padding: 15px 15px;
      background: #f8f9fa;
      border-bottom: 1px solid #ddd;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    
    .billing-header h2 {
      font-size: 15px;
      color: var(--primary-color);
      display: flex;
      align-items: center;
      gap: 5px;
    }

    .order-type-select {
      padding: 4px 8px;
      border-radius: 5px;
      border: 1px solid #ccc;
      font-size: 12px;
      background: white;
      color: var(--text-dark);
      cursor: pointer;
    }

    .billing-list-container {
      flex: 1;
      overflow-y: auto;
      padding: 0;
      list-style: none;
    }

    .billing-item {
      display: flex;
      justify-content: space-between;
      padding: 12px 15px;
      border-bottom: 1px solid #eee;
    }

    .item-info {
      flex: 1;
      padding-right: 10px;
    }

    .item-info h4 {
      font-size: 13px;
      font-weight: 600;
      margin-bottom: 2px;
    }
    
    .item-desc {
      font-size: 11px;
      color: #777;
      margin-bottom: 4px;
      line-height: 1.3;
      white-space: normal;
      word-wrap: break-word;
    }

    .item-qty {
      font-size: 11px;
      color: var(--text-muted);
    }

    .item-price-actions {
      text-align: right;
      min-width: 70px;
    }
    
    .item-price {
      font-size: 13px;
      font-weight: 600;
      color: var(--text-dark);
      margin-bottom: 8px;
    }

    .btn-delete {
      background: #ff4d4d;
      color: white;
      border: none;
      border-radius: 4px;
      padding: 4px 6px;
      font-size: 10px;
      cursor: pointer;
    }

    .billing-summary {
      padding: 12px 15px;
      background: #f8f9fa;
      border-top: 1px solid #ddd;
    }

    .summary-row {
      display: flex;
      justify-content: space-between;
      margin-bottom: 6px;
      font-size: 12px;
      color: var(--text-muted);
    }

    .summary-total {
      display: flex;
      justify-content: space-between;
      margin-top: 8px;
      font-size: 16px;
      font-weight: 700;
      color: var(--text-dark);
    }

    .action-buttons {
      display: flex;
      gap: 8px;
      margin-top: 10px;
    }
    
    .btn-secondary {
      flex: 1;
      padding: 8px;
      background: #e2e6ea;
      border: none;
      border-radius: 6px;
      color: var(--text-dark);
      font-size: 12px;
      font-weight: 600;
      cursor: pointer;
    }

    .btn-charge {
      margin-top: 8px;
      width: 100%;
      padding: 12px;
      background: var(--primary-color);
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 18px;
      font-weight: 700;
      cursor: pointer;
      box-shadow: 0 4px 10px rgba(44, 74, 133, 0.3);
      transition: background 0.2s ease;
    }

    .btn-charge:hover {
      background: #1f3768;
    }
    
    .bottom-nav {
      background: var(--primary-color);
      color: white;
      display: flex;
      padding: 10px;
    }
    .bottom-nav-item {
      flex: 1;
      text-align: center;
      font-size: 11px;
      cursor: pointer;
      opacity: 0.8;
    }
    .bottom-nav-item.active {
      opacity: 1;
      font-weight: bold;
    }
    
    /* MODAL STYLES */
    .modal-overlay {
      position: fixed;
      top: 0; left: 0; width: 100%; height: 100%;
      background: rgba(0,0,0,0.5);
      display: none;
      justify-content: center;
      align-items: center;
      z-index: 1000;
    }
    .modal-overlay.active {
      display: flex;
    }
    .modal-content {
      background: white;
      border-radius: 8px;
      width: 600px;
      text-align: left;
      box-shadow: 0 10px 25px rgba(0,0,0,0.2);
      display: flex;
      flex-direction: column;
      max-height: 90vh;
    }
    .modal-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 20px;
      border-bottom: 1px solid #eee;
    }
    .modal-header .back-btn {
      font-size: 24px;
      color: #555;
      cursor: pointer;
      text-decoration: none;
    }
    .modal-header h2 {
      font-size: 20px;
      color: var(--text-dark);
      margin: 0;
      font-weight: 600;
    }
    .modal-header .btn-charge-top {
      background: #89a3d4;
      color: white;
      border: none;
      border-radius: 6px;
      padding: 10px 20px;
      font-weight: bold;
      font-size: 14px;
      cursor: pointer;
    }
    .modal-header .btn-charge-top:hover {
      background: var(--primary-color);
    }
    .modal-subtitle {
      padding: 10px 20px;
      text-align: center;
      font-size: 12px;
      color: #89a3d4;
      background: #f9fbff;
      border-bottom: 1px solid #eee;
    }
    .modal-body {
      padding: 20px;
      overflow-y: auto;
    }
    
    .payment-row {
      display: flex;
      margin-bottom: 25px;
    }
    .payment-label {
      width: 130px;
      font-weight: 600;
      color: var(--text-dark);
      padding-top: 10px;
    }
    .payment-content {
      flex: 1;
    }
    
    .grid-buttons {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 10px;
      margin-bottom: 10px;
    }
    .btn-outline {
      padding: 12px 10px;
      background: white;
      border: 1px solid #89a3d4;
      color: #89a3d4;
      border-radius: 4px;
      font-size: 14px;
      font-weight: 600;
      cursor: pointer;
      text-align: center;
    }
    .btn-outline:hover, .btn-outline.selected {
      background: #f0f4ff;
      border-color: var(--primary-color);
      color: var(--primary-color);
    }
    
    .cash-input {
      width: 100%;
      padding: 15px;
      font-size: 16px;
      border: 1px solid #89a3d4;
      border-radius: 4px;
      outline: none;
      color: var(--primary-color);
    }
    .cash-input::placeholder {
      color: #cbd5e1;
    }
    
    hr.divider {
      border: 0;
      border-top: 1px solid #eee;
      margin: 0 0 25px 0;
    }

    .ewallet-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 10px;
    }

    /* SUCCESS MODAL STYLES */
    .success-modal-content {
      background: white;
      border-radius: 8px;
      width: 450px;
      text-align: center;
      padding: 40px 30px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    }
    .success-paid {
      color: #777;
      font-size: 16px;
      margin-bottom: 5px;
    }
    .success-change {
      color: #405d9b;
      font-size: 32px;
      font-weight: bold;
      margin-bottom: 30px;
    }
    .success-icon-wrapper {
      margin-bottom: 35px;
    }
    .success-icon {
      width: 80px;
      height: 80px;
      background: #88c290;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto;
      border: 5px solid #c3e2c6;
    }
    .success-icon span {
      color: white;
      font-size: 40px;
      font-weight: bold;
    }
    .receipt-row {
      display: flex;
      margin-bottom: 15px;
    }
    .receipt-input {
      flex: 1;
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 4px 0 0 4px;
      outline: none;
      font-size: 14px;
    }
    .receipt-btn {
      background: #a3b1d2;
      color: white;
      border: none;
      padding: 12px 20px;
      border-radius: 0 4px 4px 0;
      cursor: pointer;
      font-weight: bold;
    }
    .btn-print-receipt {
      width: 100%;
      background: #405d9b;
      color: white;
      border: none;
      padding: 15px;
      border-radius: 4px;
      font-size: 16px;
      font-weight: bold;
      cursor: pointer;
      margin-bottom: 15px;
      margin-top: 10px;
    }
    .btn-new-sale {
      width: 100%;
      background: white;
      color: #405d9b;
      border: 1px solid #405d9b;
      padding: 15px;
      border-radius: 4px;
      font-size: 16px;
      font-weight: bold;
      cursor: pointer;
    }

    /* MOBILE RESPONSIVE STYLES */
    @media (max-width: 768px) {
      body {
        flex-direction: column;
        height: auto;
        overflow-y: auto;
      }
      .menu-area {
        flex-direction: column;
      }
      .category-sidebar {
        order: -1; /* Pindahkan tab kategori ke atas layar */
        width: 100%;
        flex-direction: row;
        border-left: none;
        border-bottom: 1px solid #ddd;
        padding: 10px;
        overflow-x: auto;
        gap: 10px;
      }
      .cat-btn {
        flex: 1;
        min-width: 75px;
        padding: 10px 5px;
      }
      .cat-icon {
        margin-bottom: 3px;
      }
      .cat-icon svg {
        width: 20px;
        height: 20px;
      }
      .cat-text {
        font-size: 10px;
      }
      .grid-container {
        overflow-y: visible;
        padding: 15px;
      }
      .main-grid {
        grid-template-columns: repeat(2, 1fr); /* 2 kolom untuk menu di HP */
      }
      .billing-area {
        flex: none;
        height: auto;
        min-height: 500px;
        border-left: none;
        border-top: 2px solid var(--primary-color);
      }
      .modal-content {
        width: 95%;
      }
      .payment-row {
        flex-direction: column;
      }
      .payment-label {
        width: 100%;
        margin-bottom: 10px;
        padding-top: 0;
      }
      .grid-buttons, .ewallet-grid {
        grid-template-columns: repeat(2, 1fr);
      }
      .success-modal-content {
        width: 95%;
        padding: 25px 20px;
      }
      .receipt-row {
        flex-direction: column;
      }
      .receipt-btn {
        border-radius: 4px;
        margin-top: 5px;
      }
      .receipt-input {
        border-radius: 4px;
      }
    }
  </style>
</head>
<body>

  <!-- Kolom Kiri: Gabungan Menu Area -->
  <div class="menu-area">
    
    <!-- Bagian Grid Kiri -->
    <div class="grid-container">
        <div class="section-title" id="category-title">Menu Utama</div>
        
        <!-- Grid Menu Utama -->
        <div class="main-grid" id="grid-utama">
          @foreach ($utama as $item)
            <div class="menu-card" onclick="addToCart('{{ $item->nama }}', {{ $item->harga }})">
              <img src="{{ $item->gambar ? asset($item->gambar) : 'https://via.placeholder.com/150?text=No+Image' }}" alt="{{ $item->nama }}">
              <div class="menu-card-body">
                <h3>{{ $item->nama }}</h3>
                <p>Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
              </div>
            </div>
          @endforeach
        </div>

        <!-- Grid Topping -->
        <div class="main-grid" id="grid-topping" style="display: none;">
          @foreach ($topping as $item)
            <div class="menu-card" onclick="addToCart('{{ $item->nama }}', {{ $item->harga }})">
              <img src="{{ $item->gambar ? asset($item->gambar) : 'https://via.placeholder.com/150?text=No+Image' }}" alt="{{ $item->nama }}">
              <div class="menu-card-body">
                <h3>{{ $item->nama }}</h3>
                <p>Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
              </div>
            </div>
          @endforeach
        </div>

        <!-- Grid Minuman -->
        <div class="main-grid" id="grid-minuman" style="display: none;">
          @foreach ($minuman as $item)
            <div class="menu-card" onclick="addToCart('{{ $item->nama }}', {{ $item->harga }})">
              <img src="{{ $item->gambar ? asset($item->gambar) : 'https://via.placeholder.com/150?text=No+Image' }}" alt="{{ $item->nama }}">
              <div class="menu-card-body">
                <h3>{{ $item->nama }}</h3>
                <p>Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
              </div>
            </div>
          @endforeach
        </div>

        <!-- Grid Gudang (Inventory) -->
        <div id="grid-gudang" style="display: none;">
          <div class="section-title" style="font-size:15px; margin-top:0;">Stok Etalase (Sedang Dipakai)</div>
          <div class="main-grid">
            @foreach ($ingredients as $ing)
              @php
                 $isSyrup = str_contains(strtolower($ing->nama), 'syrup');
                 $capacity = 0; $botol_utuh = 0; $sisa_ml = 0;
                 if ($isSyrup) {
                     if (str_contains(strtolower($ing->nama), 'strawberry')) $capacity = 800;
                     elseif (str_contains(strtolower($ing->nama), 'jasmine')) $capacity = 500;
                     elseif (str_contains(strtolower($ing->nama), 'lychee')) $capacity = 300;
                     
                     if ($capacity > 0) {
                         $botol_utuh = floor($ing->stok / $capacity);
                         $sisa_ml = $ing->stok % $capacity;
                         
                         if ($sisa_ml == 0 && $ing->stok > 0) {
                             $botol_utuh--;
                             $sisa_ml = $capacity;
                         }
                     }
                 }
              @endphp

              @if (!$isSyrup)
                <div class="gudang-card">
                  <h3>{{ $ing->nama }}</h3>
                  <div class="stok-angka">{{ $ing->stok }}</div>
                  <div class="stok-satuan">{{ $ing->satuan }}</div>
                </div>
              @else
                <div class="gudang-card" style="border-color: #89a3d4; background: #f4f7ff;">
                  <h3>{{ $ing->nama }} (Terbuka)</h3>
                  @if($ing->stok > 0)
                    <div class="stok-angka">1</div>
                    <div class="stok-satuan">botol aktif</div>
                    <div style="font-size:12px; color:#e74c3c; margin-top:8px; font-weight:bold;">Sisa: {{ $sisa_ml }} ml</div>
                  @else
                    <div class="stok-angka" style="color:#e74c3c;">0</div>
                    <div class="stok-satuan">habis</div>
                    <div style="font-size:12px; color:#e74c3c; margin-top:8px; font-weight:bold;">Sisa: 0 ml</div>
                  @endif
                </div>
              @endif
            @endforeach
          </div>

          <div class="section-title" style="font-size:15px; margin-top:25px;">Stock Ready (Gudang Penyimpanan)</div>
          <div class="main-grid">
             @foreach ($ingredients as $ing)
              @php
                 $isSyrup = str_contains(strtolower($ing->nama), 'syrup');
                 if ($isSyrup) {
                     $capacity = 0;
                     if (str_contains(strtolower($ing->nama), 'strawberry')) $capacity = 800;
                     elseif (str_contains(strtolower($ing->nama), 'jasmine')) $capacity = 500;
                     elseif (str_contains(strtolower($ing->nama), 'lychee')) $capacity = 300;
                     
                     if ($capacity > 0) {
                         $botol_utuh = floor($ing->stok / $capacity);
                         $sisa_ml = $ing->stok % $capacity;
                         
                         if ($sisa_ml == 0 && $ing->stok > 0) {
                             $botol_utuh--;
                         }
                         
                         if ($botol_utuh > 0) {
                            echo '<div class="gudang-card" style="background:#fffcf5; border-color:#f1c40f;">
                                    <h3>'.$ing->nama.'</h3>
                                    <div class="stok-angka" style="color:#d35400;">'.$botol_utuh.'</div>
                                    <div class="stok-satuan">botol utuh</div>
                                  </div>';
                         }
                     }
                 }
              @endphp
             @endforeach
             <div class="gudang-card" style="border:1px dashed #ccc; background:transparent; display:flex; align-items:center; justify-content:center; cursor:pointer;" onclick="openRestockModal()">
                <span style="color:#999; font-size:12px; font-weight:bold;">+ Tambah Stok</span>
             </div>
          </div>
        </div>

        <!-- Grid History -->
        <div id="grid-history" style="display: none;">
          <div style="display: flex; gap: 10px; margin-bottom: 20px;">
             <input type="date" id="history-date" class="cash-input" style="padding: 10px;" onchange="fetchHistory()">
             <button class="btn-charge" style="width: auto; padding: 10px 20px; font-size: 14px;" onclick="fetchHistory()">Cek</button>
          </div>
          <div id="history-content">
             <!-- History items rendered here -->
             <p style="color: #777; font-size: 14px;">Silakan pilih tanggal untuk memuat riwayat.</p>
          </div>
        </div>

    </div>

    <!-- Bagian Sidebar Kategori (Tengah) -->
    <div class="category-sidebar">
        <div class="cat-btn active" id="btn-cat-utama" onclick="switchCategory('utama', 'Menu Utama')">
            <div class="cat-icon">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 2v7c0 1.1.9 2 2 2h4a2 2 0 0 0 2-2V2"/><path d="M7 2v20"/><path d="M21 15V2v0a5 5 0 0 0-5 5v6c0 1.1.9 2 2 2h3Zm0 0v7"/></svg>
            </div>
            <div class="cat-text">Menu Utama</div>
        </div>
        <div class="cat-btn" id="btn-cat-topping" onclick="switchCategory('topping', 'Topping Tambahan')">
            <div class="cat-icon">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22a10 10 0 1 0 0-20 10 10 0 0 0 0 20Z"/><path d="m15 9-6 6"/><path d="m9 9 6 6"/></svg>
            </div>
            <div class="cat-text">Topping</div>
        </div>
        <div class="cat-btn" id="btn-cat-minuman" onclick="switchCategory('minuman', 'Minuman Es')">
            <div class="cat-icon">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 10h-2V5h4V3H5v2h4v5H7l-3 9h16Z"/></svg>
            </div>
            <div class="cat-text">Minuman</div>
        </div>
        <div class="cat-btn" id="btn-cat-gudang" onclick="switchCategory('gudang', 'Gudang & Stok')">
            <div class="cat-icon">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 8.35V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V8.35A2 2 0 0 1 3.26 6.5l8-3.2a2 2 0 0 1 1.48 0l8 3.2A2 2 0 0 1 22 8.35Z"/><path d="M6 18h12"/><path d="M6 14h12"/><rect width="12" height="12" x="6" y="10"/></svg>
            </div>
            <div class="cat-text">Gudang</div>
        </div>
        <div class="cat-btn" id="btn-cat-history" onclick="switchCategory('history', 'Riwayat Transaksi'); fetchHistory();">
            <div class="cat-icon">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            </div>
            <div class="cat-text">Riwayat</div>
        </div>
    </div>

  </div>

  <!-- Kolom Kanan: Billing/Cart -->
  <div class="billing-area">
    <div class="billing-header" style="gap: 10px;">
      <input type="text" id="customer-name" placeholder="Nama Pelanggan / Antrean" style="flex: 1; padding: 6px 10px; border-radius: 5px; border: 1px solid #ccc; font-size: 13px; outline: none;">
      <select class="order-type-select" id="order-type">
        <option value="Dine In">Dine In</option>
        <option value="Take Away">Take Away</option>
        <option value="Grab">Grab</option>
        <option value="Gojek">Gojek</option>
        <option value="Shopee Food">Shopee Food</option>
      </select>
    </div>

    <ul class="billing-list-container" id="cart-list">
      <!-- Item list goes here via JS -->
    </ul>

    <div class="billing-summary">
      <div class="summary-row">
        <span>Sub-Total</span>
        <span id="sub-total">Rp 0</span>
      </div>
      <div class="summary-total">
        <span>Total</span>
        <span id="grand-total">Rp 0</span>
      </div>
      
      <div class="action-buttons">
        <button class="btn-secondary" onclick="clearCart()">Kosongkan</button>
        <button class="btn-secondary">Cetak Tagihan</button>
      </div>

      <button class="btn-charge" onclick="openPaymentModal()">
        Bayar <span id="charge-btn-total">Rp 0</span>
      </button>
    </div>
  </div>

  <!-- MODAL PEMBAYARAN -->
  <div class="modal-overlay" id="payment-modal">
    <div class="modal-content">
      
      <div class="modal-header">
        <span class="back-btn" onclick="closePaymentModal()">←</span>
        <h2 id="modal-title-total">Rp 0</h2>
        <button class="btn-charge-top" id="btn-charge-submit" onclick="submitCashPayment()">Bayar</button>
      </div>
      
      <div class="modal-subtitle">
        Pilih metode pembayaran yang tersedia
      </div>
      
      <div class="modal-body">
        
        <!-- Cash -->
        <div class="payment-row">
          <div class="payment-label">Cash</div>
          <div class="payment-content">
            <div class="grid-buttons" id="quick-cash-container">
              <!-- JS generates buttons here -->
            </div>
            <input type="number" id="custom-cash" class="cash-input" placeholder="Nominal Uang">
          </div>
        </div>
        
        <hr class="divider">
        
        <!-- QRIS -->
        <div class="payment-row">
          <div class="payment-label">QRIS</div>
          <div class="payment-content">
            <button class="btn-outline" style="width: auto; padding: 10px 20px; display: inline-flex; align-items: center; gap: 8px;" onclick="openQrisModal()">
              <img src="https://upload.wikimedia.org/wikipedia/commons/a/a2/Logo_QRIS.svg" style="height: 16px;" alt="QRIS">
              Bayar dengan QRIS
            </button>
          </div>
        </div>

        <hr class="divider">
        
        <!-- E-Wallet -->
        <div class="payment-row">
          <div class="payment-label">
            E-Wallet<br>
            <span style="font-size: 10px; color: #aaa; font-weight: normal;">Pilih E-Wallet</span>
          </div>
          <div class="payment-content">
            <div class="ewallet-grid">
              <button class="btn-outline" onclick="processCheckout('Gopay')">Gopay</button>
              <button class="btn-outline" onclick="processCheckout('OVO')">OVO</button>
              <button class="btn-outline" onclick="processCheckout('DANA')">DANA</button>
              <button class="btn-outline" onclick="processCheckout('LinkAja')">Link Aja!</button>
              <button class="btn-outline" onclick="processCheckout('ShopeePay')">ShopeePay</button>
              <button class="btn-outline" onclick="processCheckout('Kredivo')">Kredivo</button>
            </div>
          </div>
        </div>

        <hr class="divider">

        <!-- EDC -->
        <div class="payment-row">
          <div class="payment-label">EDC</div>
          <div class="payment-content">
            <div class="ewallet-grid">
              <button class="btn-outline" onclick="processCheckout('EDC BCA')">BCA</button>
              <button class="btn-outline" onclick="processCheckout('EDC Mandiri')">Mandiri</button>
              <button class="btn-outline" onclick="processCheckout('EDC BNI')">BNI</button>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

  <!-- SUCCESS MODAL -->
  <div class="modal-overlay" id="success-modal">
    <div class="success-modal-content">
      
      <div class="success-paid" id="success-paid-text">Dibayar Rp 0</div>
      <div class="success-change" id="success-change-text">Kembalian Rp 0</div>
      
      <div class="success-icon-wrapper">
        <div class="success-icon">
          <span>✓</span>
        </div>
      </div>
      
      <div class="receipt-row">
        <input type="email" class="receipt-input" placeholder="Email Receipt">
        <button class="receipt-btn" onclick="alert('Email terkirim!')">Send</button>
      </div>
      
      <div class="receipt-row">
        <input type="text" class="receipt-input" placeholder="SMS Receipt">
        <button class="receipt-btn" onclick="alert('SMS terkirim!')">Send</button>
      </div>
      
      <button class="btn-print-receipt" onclick="alert('Mencetak struk...')">Cetak Struk</button>
      
      <button class="btn-new-sale" onclick="closeSuccessModal()">Pesanan Baru</button>
      
    </div>
  </div>

  <!-- RESTOCK MODAL -->
  <div class="modal-overlay" id="restock-modal">
    <div class="modal-content" style="width: 400px; padding: 25px; text-align: center;">
      
      <div class="modal-header" style="border:none; padding:0 0 15px 0;">
        <span class="back-btn" onclick="closeRestockModal()">←</span>
        <h2 style="width:100%; text-align:center;">Otorisasi Gudang</h2>
      </div>
      
      <!-- Auth View -->
      <div id="restock-auth-view">
        <p style="margin-bottom:15px; font-size:13px; color:#555;">Masukkan password manajer untuk menambah stok.</p>
        <input type="password" id="restock-password" class="cash-input" placeholder="Password" style="text-align:center; margin-bottom:15px;">
        <button class="btn-charge" onclick="verifyRestockAuth()">Login</button>
      </div>

      <!-- Form View -->
      <div id="restock-form-view" style="display:none; text-align:left;">
        <label style="font-weight:bold; font-size:13px; margin-bottom:5px; display:block;">Pilih Bahan / Item</label>
        <select id="restock-item" class="cash-input" style="margin-bottom: 15px; padding: 10px;">
          @foreach($ingredients as $ing)
            <option value="{{ $ing->id }}">{{ $ing->nama }} ({{ $ing->satuan }})</option>
          @endforeach
        </select>
        
        <label style="font-weight:bold; font-size:13px; margin-bottom:5px; display:block;">Jumlah Ditambahkan (Berdasarkan Satuan Item)</label>
        <input type="number" id="restock-qty" class="cash-input" placeholder="Contoh: 10 atau 800" style="margin-bottom:20px; padding:10px;">
        
        <button class="btn-charge" id="btn-submit-restock" onclick="submitRestock()">Simpan Stok</button>
      </div>
      
    </div>
  </div>

  <!-- QRIS MODAL -->
  <div class="modal-overlay" id="qris-modal">
    <div class="modal-content" style="width: 350px; text-align: center; padding: 30px;">
      <h3 style="margin-bottom: 10px;">Scan QRIS</h3>
      <p style="font-size: 13px; color: #777; margin-bottom: 20px;">Silakan arahkan kamera Anda ke kode QR di bawah ini untuk melakukan pembayaran.</p>
      
      <div style="background: #fff; padding: 15px; border-radius: 10px; display: inline-block; box-shadow: 0 4px 15px rgba(0,0,0,0.1); margin-bottom: 20px;">
        <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=Pembayaran+QRIS+Koben+Kasir" alt="QRIS Code" style="width: 200px; height: 200px; border-radius: 5px;">
      </div>
      
      <h2 id="qris-modal-total" style="color: #405d9b; margin-bottom: 25px;">Rp 0</h2>
      
      <div style="display: flex; gap: 10px;">
        <button class="btn-secondary" style="flex: 1;" onclick="closeQrisModal()">Batal</button>
        <button class="btn-charge" style="flex: 1;" onclick="simulateQrisPayment()">Verifikasi</button>
      </div>
    </div>
  </div>

  <script>
    const cartList = document.getElementById("cart-list");
    const subTotalEl = document.getElementById("sub-total");
    const grandTotalEl = document.getElementById("grand-total");
    const chargeBtnTotal = document.getElementById("charge-btn-total");
    const modalTitleTotal = document.getElementById("modal-title-total");
    const customCashInput = document.getElementById("custom-cash");
    const quickCashContainer = document.getElementById("quick-cash-container");
    const paymentModal = document.getElementById('payment-modal');
    
    // Success Modal elements
    const successModal = document.getElementById('success-modal');
    const successPaidText = document.getElementById('success-paid-text');
    const successChangeText = document.getElementById('success-change-text');
    const qrisModal = document.getElementById('qris-modal');
    const qrisModalTotal = document.getElementById('qris-modal-total');

    let grandTotalValue = 0;

    // Switch Category Logic
    function switchCategory(catId, title) {
        // Sembunyikan semua grid
        document.getElementById('grid-utama').style.display = 'none';
        document.getElementById('grid-topping').style.display = 'none';
        document.getElementById('grid-minuman').style.display = 'none';
        document.getElementById('grid-gudang').style.display = 'none';
        document.getElementById('grid-history').style.display = 'none';
        
        // Hilangkan class active dari semua tombol
        document.getElementById('btn-cat-utama').classList.remove('active');
        document.getElementById('btn-cat-topping').classList.remove('active');
        document.getElementById('btn-cat-minuman').classList.remove('active');
        document.getElementById('btn-cat-gudang').classList.remove('active');
        document.getElementById('btn-cat-history').classList.remove('active');
        
        // Tampilkan yang dipilih
        if(catId === 'history' || catId === 'gudang') {
            document.getElementById('grid-' + catId).style.display = 'block';
        } else {
            document.getElementById('grid-' + catId).style.display = 'grid';
        }
        document.getElementById('btn-cat-' + catId).classList.add('active');
        
        // Ubah judul
        document.getElementById('category-title').textContent = title;
    }

    function getMenuDescription(nama) {
        let n = nama.toLowerCase();
        
        if (n === 'beef teriyaki a') return 'Nasi + Salad + Beef Teriyaki + Egg Roll 1 + Ebi Furay';
        if (n === 'beef teriyaki b') return 'Nasi + Salad + Beef Teriyaki + Egg Roll 2 + Ebi Furay';
        if (n === 'chicken katsu') return 'Nasi + Salad + Chicken Katsu';
        if (n === 'chicken teriyaki a') return 'Nasi + Salad + Chicken Teriyaki + Chicken Spicy 2 + Ekkado';
        if (n === 'chicken teriyaki b') return 'Nasi + Salad + Chicken Teriyaki + Chicken Spicy + Ekkado';
        if (n === 'hemat a') return 'Nasi + Salad + Egg Roll 2';
        if (n === 'mix b') return 'Nasi + Ebi Furay + Salad + Egg Roll';
        if (n === 'mix c') return 'Nasi + Salad + Egg Roll 2 + Chicken Spicy';
        if (n === 'mix d') return 'Nasi + Salad + Ekkado + Chicken Spicy + Egg Roll';
        if (n === 'mix e') return 'Nasi + Salad + Menu Lengkap';
        
        // Topping dan Minuman tidak pakai keterangan
        return '';
    }

    let cart = {};

    function addToCart(nama, harga) {
      if (cart[nama]) {
        cart[nama].qty += 1;
      } else {
        cart[nama] = { 
          nama, 
          harga, 
          qty: 1,
          desc: getMenuDescription(nama)
        };
      }
      renderCart();
    }

    function removeFromCart(nama) {
      if (cart[nama]) {
        if (cart[nama].qty > 1) {
          cart[nama].qty -= 1;
        } else {
          delete cart[nama];
        }
      }
      renderCart();
    }
    
    function deleteItemEntirely(nama) {
      delete cart[nama];
      renderCart();
    }
    
    function clearCart() {
      if(confirm('Hapus semua pesanan?')) {
        cart = {};
        renderCart();
      }
    }

    function renderCart() {
      cartList.innerHTML = "";
      grandTotalValue = 0;

      Object.values(cart).forEach(item => {
        const itemTotal = item.harga * item.qty;
        grandTotalValue += itemTotal;

        const li = document.createElement("li");
        li.className = "billing-item";
        
        li.innerHTML = `
          <div class="item-info">
            <h4>${item.nama}</h4>
            <div class="item-desc" style="${item.desc ? '' : 'display: none;'}">${item.desc}</div>
            <p class="item-qty">Qty: ${item.qty} x Rp ${item.harga.toLocaleString('id-ID')}</p>
          </div>
          <div class="item-price-actions">
            <div class="item-price">Rp ${itemTotal.toLocaleString('id-ID')}</div>
            <button class="btn-delete" onclick="removeFromCart('${item.nama}')">-1</button>
            <button class="btn-delete" onclick="deleteItemEntirely('${item.nama}')">Hapus</button>
          </div>
        `;
        cartList.appendChild(li);
      });

      const formattedTotal = "Rp " + grandTotalValue.toLocaleString('id-ID');
      subTotalEl.textContent = formattedTotal;
      grandTotalEl.textContent = formattedTotal;
      chargeBtnTotal.textContent = formattedTotal;
    }

    // Payment Modal Logic
    function openPaymentModal() {
      const customerNameInput = document.getElementById('customer-name');
      if (!customerNameInput.value || customerNameInput.value.trim() === '') {
        alert("Nama pelanggan / antrean harus diisi terlebih dahulu!");
        customerNameInput.focus();
        return;
      }

      if (Object.keys(cart).length === 0) {
        alert("Keranjang masih kosong!");
        return;
      }
      
      const formattedTotal = "Rp " + grandTotalValue.toLocaleString('id-ID');
      modalTitleTotal.textContent = formattedTotal;
      customCashInput.value = "";
      
      generateQuickCashButtons(grandTotalValue);
      paymentModal.classList.add('active');
    }

    function closePaymentModal() {
      paymentModal.classList.remove('active');
      document.getElementById('btn-charge-submit').textContent = "Bayar";
    }
    
    function openQrisModal() {
      qrisModalTotal.textContent = "Rp " + grandTotalValue.toLocaleString('id-ID');
      qrisModal.classList.add('active');
    }

    function closeQrisModal() {
      qrisModal.classList.remove('active');
    }

    function simulateQrisPayment() {
      closeQrisModal();
      processCheckout('QRIS');
    }
    
    function getNextRounding(val) {
        if(val <= 50000) {
            let next10k = Math.ceil(val / 10000) * 10000;
            return [val, next10k, 50000, 100000];
        } else if(val <= 100000) {
            let next10k = Math.ceil(val / 10000) * 10000;
            return [val, next10k, 100000, 150000];
        } else {
            let next50k = Math.ceil(val / 50000) * 50000;
            return [val, next50k, next50k + 50000];
        }
    }

    function generateQuickCashButtons(total) {
      quickCashContainer.innerHTML = '';
      
      let rawArr = getNextRounding(total);
      let uniqueArr = [...new Set(rawArr)].filter(v => v >= total).slice(0, 3);
      
      uniqueArr.forEach(amount => {
        const btn = document.createElement('button');
        btn.className = 'btn-outline';
        btn.textContent = 'Rp ' + amount.toLocaleString('id-ID');
        btn.onclick = () => {
          customCashInput.value = amount;
          document.querySelectorAll('.btn-outline').forEach(b => b.classList.remove('selected'));
          btn.classList.add('selected');
        };
        quickCashContainer.appendChild(btn);
      });
    }
    
    function submitCashPayment() {
      if(!customCashInput.value || customCashInput.value < grandTotalValue) {
          alert("Masukkan nominal tunai yang valid (minimal Rp " + grandTotalValue.toLocaleString('id-ID') + ")");
          return;
      }
      processCheckout('Cash');
    }

    async function processCheckout(method) {
      const orderType = document.getElementById('order-type').value;
      const customerName = document.getElementById('customer-name').value;
      const payload = Object.values(cart).map(item => ({
          nama: item.nama,
          harga: item.harga,
          jumlah: item.qty
      }));

      const btnSubmit = document.getElementById('btn-charge-submit');
      btnSubmit.textContent = "Loading...";

      let cashPaid = grandTotalValue;
      let change = 0;
      if (method === 'Cash') {
          cashPaid = parseInt(customCashInput.value) || grandTotalValue;
          change = cashPaid - grandTotalValue;
      }

      try {
        const response = await fetch('/checkout', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
          },
          body: JSON.stringify({ cart: payload, method: method, orderType: orderType, customerName: customerName })
        });
        
        const result = await response.json();
        if (result.success) {
          closePaymentModal();
          showSuccessModal(cashPaid, change, method);
          cart = {};
          renderCart();
        } else {
          alert(result.message); 
        }
      } catch (error) {
        console.error(error);
        alert("Terjadi kesalahan sistem saat menghubungi server!");
      } finally {
        btnSubmit.textContent = "Bayar";
      }
    }

    // Success Modal Logic
    function showSuccessModal(paid, change, method) {
      if (method === 'Cash') {
        successPaidText.textContent = "Dibayar Rp " + paid.toLocaleString('id-ID');
        if(change > 0) {
            successChangeText.textContent = "Kembalian Rp " + change.toLocaleString('id-ID');
        } else {
            successChangeText.textContent = "Uang Pas";
        }
      } else {
        successPaidText.textContent = "Dibayar via " + method;
        successChangeText.textContent = "Pembayaran Berhasil";
      }
      
      successModal.classList.add('active');
    }

    function closeSuccessModal() {
      successModal.classList.remove('active');
    }

    // Restock Logic
    function openRestockModal() {
      document.getElementById('restock-modal').classList.add('active');
      document.getElementById('restock-auth-view').style.display = 'block';
      document.getElementById('restock-form-view').style.display = 'none';
      document.getElementById('restock-password').value = '';
      document.getElementById('restock-qty').value = '';
    }

    function closeRestockModal() {
      document.getElementById('restock-modal').classList.remove('active');
    }

    function verifyRestockAuth() {
      const pwd = document.getElementById('restock-password').value;
      if (pwd === 'koben123') {
         document.getElementById('restock-auth-view').style.display = 'none';
         document.getElementById('restock-form-view').style.display = 'block';
      } else {
         alert('Password salah!');
      }
    }

    async function submitRestock() {
      const id = document.getElementById('restock-item').value;
      const qty = document.getElementById('restock-qty').value;
      const pwd = document.getElementById('restock-password').value;

      if (!qty || qty <= 0) {
         alert('Masukkan jumlah stok yang valid!');
         return;
      }

      const btn = document.getElementById('btn-submit-restock');
      btn.textContent = 'Menyimpan...';

      try {
        const response = await fetch('/restock', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
          },
          body: JSON.stringify({ id, qty, password: pwd })
        });
        
        const result = await response.json();
        if (result.success) {
          alert(result.message);
          location.reload(); // Muat ulang halaman untuk melihat stok baru
        } else {
          alert(result.message); 
        }
      } catch (error) {
        console.error(error);
        alert("Terjadi kesalahan sistem!");
      } finally {
        btn.textContent = 'Simpan Stok';
      }
    }
    async function fetchHistory() {
        const dateInput = document.getElementById('history-date').value;
        const historyContent = document.getElementById('history-content');
        
        if (!dateInput) return;
        
        historyContent.innerHTML = '<p style="color: #777; font-size: 14px;">Memuat riwayat...</p>';
        
        try {
            const response = await fetch(`/history?date=${dateInput}`);
            const result = await response.json();
            
            if (result.success && result.data.length > 0) {
                let html = '';
                result.data.forEach(trx => {
                    let itemsHtml = '';
                    trx.items.forEach(item => {
                        itemsHtml += `
                            <div style="display: flex; justify-content: space-between; font-size: 13px; margin-bottom: 5px; border-bottom: 1px dashed #eee; padding-bottom: 5px;">
                                <span>${item.jumlah}x ${item.menu}</span>
                                <span>Rp ${item.total.toLocaleString('id-ID')}</span>
                            </div>
                        `;
                    });
                    
                    html += `
                        <div style="background: white; border: 1px solid #ddd; border-radius: 8px; padding: 15px; margin-bottom: 15px;">
                            <div style="display: flex; justify-content: space-between; align-items: center; cursor: pointer;" onclick="document.getElementById('detail-${trx.receipt_no}').style.display = document.getElementById('detail-${trx.receipt_no}').style.display === 'none' ? 'block' : 'none'">
                                <div>
                                    <div style="font-weight: bold; font-size: 15px; color: var(--primary-color);">${trx.customer_name}</div>
                                    <div style="font-size: 12px; color: #888;">${trx.time}</div>
                                </div>
                                <div style="font-weight: bold;">Rp ${trx.total_harga.toLocaleString('id-ID')}</div>
                            </div>
                            <div id="detail-${trx.receipt_no}" style="display: none; margin-top: 15px; background: #f9f9f9; padding: 10px; border-radius: 5px;">
                                ${itemsHtml}
                            </div>
                        </div>
                    `;
                });
                historyContent.innerHTML = html;
            } else {
                historyContent.innerHTML = '<p style="color: #777; font-size: 14px;">Tidak ada transaksi pada tanggal ini.</p>';
            }
        } catch (error) {
            console.error(error);
            historyContent.innerHTML = '<p style="color: red; font-size: 14px;">Gagal memuat data.</p>';
        }
    }
    
    // Set default history date to today
    document.getElementById('history-date').value = new Date().toISOString().split('T')[0];
  </script>
</body>
</html>
