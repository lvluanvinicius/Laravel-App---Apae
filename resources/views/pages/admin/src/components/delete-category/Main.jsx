import React from 'react';
import ReactDOM from 'react-dom/client';
import { deletePostCategory } from '../../services';

function CategoryDelete({ categoryId }) {
  async function onDeleteCategory() {
    if (confirm('Deseja realmente excluír essa categoria?')) {
      const response = await deletePostCategory(categoryId);

      if (response.status) {
        alert(response.message);
        window.location.reload();
        return null;
      }

      alert(response.message);
    }
  }

  return (
    <button onClick={onDeleteCategory} className="text-apae-danger">
      <i className="fa-solid fa-trash"></i>
    </button>
  );
}

const btnDeleteList = document.querySelectorAll('.button-delete-post-category');

for (let btn of btnDeleteList) {
  const newsId = btn.querySelector('div[data-category-id]');
  ReactDOM.createRoot(btn).render(
    <CategoryDelete categoryId={newsId.attributes['data-category-id'].value} />
  );
}
