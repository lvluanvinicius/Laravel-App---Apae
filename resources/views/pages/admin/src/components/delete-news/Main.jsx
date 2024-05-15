import React from 'react';
import ReactDOM from 'react-dom/client';
import { deletePostNews } from '../../services';

function NewsDelete({ newsId }) {
  async function onDeleteNews() {
    if (confirm('Deseja realmente excluír essa notícia?')) {
      const response = await deletePostNews(newsId);

      if (response.status) {
        alert(response.message);
        window.location.reload();
        return null;
      }

      alert(response.message);
    }
  }

  return (
    <button
      onClick={onDeleteNews}
      style={{ background: '#dc3545' }}
      className="text-apae-white rounded-md px-4 py-1"
    >
      <i className="fa-solid fa-trash"></i> Apagar
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
