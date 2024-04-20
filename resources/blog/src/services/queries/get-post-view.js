import { api } from '../api';

export async function getPostView(slug) {
  const response = await api.get(`blog/posts/${slug}`);

  if (response.data) {
    return response.data;
  }

  throw new Error(
    'Erro ao tentar recuperar o post, por favor, tente novamente.'
  );
}
