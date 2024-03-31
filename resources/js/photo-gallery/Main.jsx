import React from 'react';
import ReactDOM from 'react-dom/client';
import { View } from './View';

if (document.getElementById('gallery-content')) {
  const Index = ReactDOM.createRoot(document.getElementById('gallery-content'));

  Index.render(
    <React.StrictMode>
      <View />
    </React.StrictMode>
  );
}
