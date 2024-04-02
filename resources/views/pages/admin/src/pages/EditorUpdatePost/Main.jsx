import React from 'react';
import ReactDOM from 'react-dom/client';
import { EditorUpdatePost } from '.';

if (document.getElementById('news-edit')) {
  const container = ReactDOM.createRoot(document.getElementById('news-edit'));

  container.render(
    <>
      <EditorUpdatePost />
    </>
  );
}
