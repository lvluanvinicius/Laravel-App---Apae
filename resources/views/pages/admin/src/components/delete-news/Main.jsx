import React from 'react';
import ReactDOM from 'react-dom/client';
import { deletePostEdit } from '../../services';

function NewsDelete({ newsId }) {
  async function onDeleteNews() {
    if (confirm('Deseja realmente excluír essa notícia?')) {
      const response = await deletePostEdit(newsId);

      if (response.status) {
        alert(response.message);
        window.location.reload();
        return null;
      }

      alert(response.message);
    }
  }

  return (
    <button onClick={onDeleteNews} className="text-apae-danger">
      <i className="fa-solid fa-trash"></i>
    </button>
  );
}

const btnDeleteList = document.querySelectorAll('.button-delete-post-news');

for (let btn of btnDeleteList) {
  const newsId = btn.querySelector('div[data-news-id]');
  ReactDOM.createRoot(btn).render(
    <NewsDelete newsId={newsId.attributes['data-news-id'].value} />
  );
}
