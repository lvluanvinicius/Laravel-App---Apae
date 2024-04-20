import { api } from '../api';

export async function createPostsComment({ slug, data }) {
  const response = await api.post(`/blog/posts/comments/${slug}`, data);

  if (response.data) {
    return response.data;
  }

  throw new Error(
    'Erro ao tentar efetuar seu comentário, por favor, tente novamente. '
  );
}
