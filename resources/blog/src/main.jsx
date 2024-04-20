import React from 'react';
import ReactDOM from 'react-dom/client';
import { ApaeBlogContextProvider } from './contexts/blog';
import './index.css';
import './services';
import { RouterProvider } from 'react-router-dom';
import { router } from './routes';
import { Helmet, HelmetProvider } from 'react-helmet-async';
import { QueryClientProvider } from '@tanstack/react-query';
import { queryClient } from './services/react-query';

if (document.getElementById('blog-root')) {
  const Init = ReactDOM.createRoot(document.getElementById('blog-root'));
  Init.render(
    <ApaeBlogContextProvider>
      <QueryClientProvider client={queryClient}>
        <HelmetProvider>
          <Helmet titleTemplate="%s | Apae Chavantes" />
          <RouterProvider router={router} />
        </HelmetProvider>
      </QueryClientProvider>
    </ApaeBlogContextProvider>
  );
}
