import React from 'react';
import { createBrowserRouter } from 'react-router-dom';
import { Home } from './pages/Home';
import { Blog } from './layouts/blog';
import { ViewPost } from './pages/ViewPost';

export const router = createBrowserRouter([
  {
    path: '/blog',
    element: <Blog />,
    children: [
      {
        path: '',
        element: <Home />,
      },
      {
        path: 'view/:postId',
        element: <ViewPost />,
      },
    ],
  },
]);
