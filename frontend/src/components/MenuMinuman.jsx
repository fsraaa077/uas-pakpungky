import React from 'react';
import MenuGrid from './MenuGrid';

function MenuMinuman({ items, onAddToCart, formatRupiah }) {
  return (
    <>
      <div className="section-title">Minuman</div>
      <MenuGrid items={items} onAddToCart={onAddToCart} formatRupiah={formatRupiah} />
    </>
  );
}

export default MenuMinuman;
