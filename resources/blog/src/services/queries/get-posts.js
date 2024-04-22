import { api } from '../api';

export async function getPosts({ pageIndex, search }) {
  const response = await api.get('/blog/posts', {
    params: { page: pageIndex, search },
  });

  if (response.data) {
    return response.data;
  }

  throw new Error('Erro ao tentar recuperar as publicações.');
}
