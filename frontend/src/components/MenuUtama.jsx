import React from 'react';
import MenuGrid from './MenuGrid';

function MenuUtama({ items, onAddToCart, formatRupiah }) {
  return (
    <>
      <div className="section-title">Menu Utama</div>
      <MenuGrid items={items} onAddToCart={onAddToCart} formatRupiah={formatRupiah} />
    </>
  );
}

export default MenuUtama;
