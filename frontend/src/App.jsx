import React, { useState, useEffect } from 'react';
import axios from 'axios';
import './index.css';

import MenuUtama from './components/MenuUtama';
import MenuMinuman from './components/MenuMinuman';
import MenuTopping from './components/MenuTopping';
import Gudang from './components/Gudang';

// Configure Axios defaults
axios.defaults.baseURL = 'http://127.0.0.1:8000';
axios.defaults.headers.common['Accept'] = 'application/json';

function App() {
  const [data, setData] = useState({
    utama: [],
    topping: [],
    minuman: [],
    ingredients: []
  });
  const [activeCategory, setActiveCategory] = useState('utama');
  const [cart, setCart] = useState([]);
  const [customerName, setCustomerName] = useState('');
  const [showPayment, setShowPayment] = useState(false);
  const [cashGiven, setCashGiven] = useState('');

  useEffect(() => {
    fetchData();
  }, []);

  const fetchData = async () => {
    try {
      const response = await axios.get('/api/menu');
      if (response.data.success) {
        setData(response.data.data);
      }
    } catch (error) {
      console.error('Error fetching data:', error);
    }
  };

  const addToCart = (item) => {
    setCart(prev => {
      const existing = prev.find(i => i.nama === item.nama);
      if (existing) {
        return prev.map(i => i.nama === item.nama ? { ...i, jumlah: i.jumlah + 1 } : i);
      }
      return [...prev, { nama: item.nama, harga: item.harga, jumlah: 1 }];
    });
  };

  const updateCartQty = (nama, delta) => {
    setCart(prev => prev.map(item => {
      if (item.nama === nama) {
        return { ...item, jumlah: Math.max(1, item.jumlah + delta) };
      }
      return item;
    }));
  };

  const removeFromCart = (nama) => {
    setCart(prev => prev.filter(i => i.nama !== nama));
  };

  const total = cart.reduce((sum, item) => sum + (item.harga * item.jumlah), 0);

  const formatRupiah = (num) => {
    return 'Rp ' + num.toLocaleString('id-ID');
  };

  const handleCheckout = async () => {
    if (!customerName) return alert('Nama pelanggan harus diisi!');
    if (cart.length === 0) return alert('Keranjang kosong!');

    try {
      const response = await axios.post('/api/checkout', { cart, customerName });
      if (response.data.success) {
        alert('Transaksi berhasil disimpan!');
        setCart([]);
        setCustomerName('');
        setShowPayment(false);
        setCashGiven('');
        fetchData();
      } else {
        alert(response.data.message);
      }
    } catch (error) {
      alert('Checkout gagal!');
    }
  };

  const categories = [
    { key: 'utama', label: 'Utama', icon: '🍽️' },
    { key: 'topping', label: 'Topping', icon: '🧀' },
    { key: 'minuman', label: 'Minuman', icon: '🥤' },
    { key: 'gudang', label: 'Gudang', icon: '📦' },
  ];

  const renderActiveCategory = () => {
    switch (activeCategory) {
      case 'utama':
        return <MenuUtama items={data.utama} onAddToCart={addToCart} formatRupiah={formatRupiah} />;
      case 'minuman':
        return <MenuMinuman items={data.minuman} onAddToCart={addToCart} formatRupiah={formatRupiah} />;
      case 'topping':
        return <MenuTopping items={data.topping} onAddToCart={addToCart} formatRupiah={formatRupiah} />;
      case 'gudang':
        return <Gudang ingredients={data.ingredients} />;
      default:
        return null;
    }
  };

  return (
    <div className="app-layout">

      {/* Category Sidebar */}
      <div className="category-sidebar">
        {categories.map(cat => (
          <button
            key={cat.key}
            onClick={() => setActiveCategory(cat.key)}
            className={`cat-btn ${activeCategory === cat.key ? 'active' : ''}`}
          >
            <div className="cat-icon">{cat.icon}</div>
            {cat.label}
          </button>
        ))}
      </div>

      {/* Main Grid Area */}
      <div className="grid-container">
        {renderActiveCategory()}
      </div>

      {/* Billing Area */}
      <div className="billing-area">
        <div className="billing-header">
          <h2>🧾 Pesanan Baru</h2>
          <input
            type="text"
            placeholder="Nama Pelanggan..."
            value={customerName}
            onChange={(e) => setCustomerName(e.target.value)}
          />
        </div>

        <div className="billing-list">
          {cart.length === 0 && (
            <div className="billing-empty">Belum ada pesanan. Klik menu untuk menambahkan.</div>
          )}
          {cart.map((item, idx) => (
            <div key={idx} className="billing-item">
              <div className="item-info">
                <h4>{item.nama}</h4>
                <div className="item-qty-controls">
                  <button className="qty-btn" onClick={() => updateCartQty(item.nama, -1)}>−</button>
                  <span className="item-qty-count">{item.jumlah}</span>
                  <button className="qty-btn" onClick={() => updateCartQty(item.nama, 1)}>+</button>
                </div>
              </div>
              <div className="item-price-actions">
                <div className="item-price">{formatRupiah(item.harga * item.jumlah)}</div>
                <button className="btn-delete" onClick={() => removeFromCart(item.nama)}>Hapus</button>
              </div>
            </div>
          ))}
        </div>

        <div className="billing-summary">
          <div className="summary-total">
            <span>Total</span>
            <span>{formatRupiah(total)}</span>
          </div>
          <button
            className="btn-charge"
            onClick={() => setShowPayment(true)}
            disabled={cart.length === 0}
          >
            BAYAR — {formatRupiah(total)}
          </button>
        </div>
      </div>

      {/* Payment Modal */}
      {showPayment && (
        <div className="modal-overlay">
          <div className="modal-content">
            <h2>Pembayaran</h2>
            <div className="modal-total-row">
              <span>Total Tagihan:</span>
              <span className="amount">{formatRupiah(total)}</span>
            </div>

            <label className="modal-label">Nominal Uang (Rp)</label>
            <input
              type="number"
              className="modal-input"
              placeholder="Masukkan nominal..."
              value={cashGiven}
              onChange={(e) => setCashGiven(e.target.value)}
            />

            {Number(cashGiven) >= total && Number(cashGiven) > 0 && (
              <div className="change-display">
                Kembalian: {formatRupiah(Number(cashGiven) - total)}
              </div>
            )}

            <div className="modal-actions">
              <button className="btn-cancel" onClick={() => setShowPayment(false)}>Batal</button>
              <button className="btn-process" onClick={handleCheckout}>Proses & Simpan</button>
            </div>
          </div>
        </div>
      )}
    </div>
  );
}

export default App;
