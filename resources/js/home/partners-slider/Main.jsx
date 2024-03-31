import React from 'react';
import ReactDOM from 'react-dom/client';
import { PartnersSlider } from '.';

if (document.getElementById('partners-slider')) {
  const container = ReactDOM.createRoot(
    document.getElementById('partners-slider')
  );

  container.render(<PartnersSlider />);
}
