import React from 'react';
import ReactDOM from 'react-dom/client';
import { EditorNewPost } from '.';

if (document.getElementById('create-news-editor')) {
  console.log('====================================');
  console.log('create-news-editor');
  console.log('====================================');
  const container = ReactDOM.createRoot(
    document.getElementById('create-news-editor')
  );

  container.render(
    <>
      <EditorNewPost />
    </>
  );
}
