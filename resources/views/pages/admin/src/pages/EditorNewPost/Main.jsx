import React from 'react';
import ReactDOM from 'react-dom/client';
import { EditorNewPost } from '.';
// import 'react-quill/dist/quill.snow.css';

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
