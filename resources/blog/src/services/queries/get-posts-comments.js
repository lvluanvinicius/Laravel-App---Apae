import { api } from '../api';

export async function getPostsComments({ slug, pageIndex }) {
  const response = await api.get(`/blog/posts/comments/${slug}`, {
    params: {
      page: pageIndex,
    },
  });

  if (response.data) {
    return response.data;
  }

  throw new Error('Erro ao tentar recuperar as publicações.');
}
