import React from 'react';
import { createBrowserRouter } from 'react-router-dom';
import { Home } from './pages/Home';
import { Blog } from './layouts/blog';
import { ViewPost } from './pages/ViewPost';

export const router = createBrowserRouter([
  {
    path: '/blog',
    element: <Blog />,
    errorElement: <div>Página solicitada, não existe.</div>,
    children: [
      {
        path: '',
        element: <Home />,
      },
      {
        path: ':slug',
        element: <ViewPost />,
      },
    ],
  },
]);
