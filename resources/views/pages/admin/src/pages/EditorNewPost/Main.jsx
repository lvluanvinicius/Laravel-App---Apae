import React from 'react';
import ReactDOM from 'react-dom/client';
import { EditorNewPost } from '.';

import '../../styles/quill.snow.css';

if (document.getElementById('create-news-editor')) {
  const container = ReactDOM.createRoot(
    document.getElementById('create-news-editor')
  );

  container.render(
    <>
      <EditorNewPost />
    </>
  );
}
