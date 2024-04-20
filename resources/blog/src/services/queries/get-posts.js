import { api } from '../api';

export async function getPosts() {
  const response = await api.get('/blog/posts');

  if (response.data) {
    return response.data;
  }

  throw new Error('Erro ao tentar recuperar as publicações.');
}
