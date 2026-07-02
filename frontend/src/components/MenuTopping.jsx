import React from 'react';
import MenuGrid from './MenuGrid';

function MenuTopping({ items, onAddToCart, formatRupiah }) {
  return (
    <>
      <div className="section-title">Topping</div>
      <MenuGrid items={items} onAddToCart={onAddToCart} formatRupiah={formatRupiah} />
    </>
  );
}

export default MenuTopping;
