import React from 'react';
import ReactDOM from 'react-dom/client';
import { ApaeBlogContextProvider } from './contexts/blog';
import './index.css';
import './services';
import { RouterProvider } from 'react-router-dom';
import { router } from './routes';
import { Helmet, HelmetProvider } from 'react-helmet-async';

if (document.getElementById('blog-root')) {
  const Init = ReactDOM.createRoot(document.getElementById('blog-root'));
  Init.render(
    <ApaeBlogContextProvider>
      <HelmetProvider>
        <Helmet titleTemplate="%s | Apae Chavantes" />
        <RouterProvider router={router} />
      </HelmetProvider>
    </ApaeBlogContextProvider>
  );
}
