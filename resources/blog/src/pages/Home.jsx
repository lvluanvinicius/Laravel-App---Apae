import React, { useContext } from 'react';
import { Helmet } from 'react-helmet-async';
import { ApaeBlogContext } from '../contexts/blog';
import { HomePosts } from '../components/home-posts/HomePosts';
import { DetailsPosts } from '../components/DetailsPosts';
import { useQuery } from '@tanstack/react-query';
import { getPosts } from '../services/queries/get-posts';
import { useSearchParams } from 'react-router-dom';
import { useForm } from 'react-hook-form';

import {
  Search,
  ChevronLeft,
  ChevronRight,
  ChevronsLeft,
  ChevronsRight,
} from 'lucide-react';
import styled from 'styled-components';

const Paginate = styled.div`
  width: 100%;
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-size: 0.8rem;

  .controllers {
    display: flex;
    align-items: center;
    gap: 1rem;
  }

  & .buttons {
    flex: 1;
    display: flex;
    align-items: center;
    gap: 0.7rem;

    button {
      cursor: pointer;
      background: none;
      width: 2rem;
      height: 2rem;
      border-radius: 4px;

      display: flex;
      align-items: center;
      justify-content: center;

      &:hover {
        background: var(--darker-100);
      }
    }
  }
`;

export function Home() {
  const { app_settings } = useContext(ApaeBlogContext);
  const [searchParams, setSearchParams] = useSearchParams();

  const pageIndex = searchParams.get('page')
    ? parseInt(searchParams.get('page'))
    : 1;

  const search = searchParams.get('search') ? searchParams.get('search') : '';

  const { register, handleSubmit } = useForm({
    values: {
      search: search ?? '',
    },
  });

  const { data: posts } = useQuery({
    queryKey: ['posts', pageIndex, search],
    queryFn: () => getPosts({ pageIndex, search }),
  });

  async function handleSearchSubmit({ search }) {
    setSearchParams((state) => {
      if (search) {
        state.set('search', search);
      } else {
        state.delete('search');
      }

      return state;
    });
  }

  function onChangePage(pageIndex) {
    setSearchParams((state) => {
      state.set('page', pageIndex.toString());
      return state;
    });
  }

  const pages =
    Math.ceil(posts?.data.posts.total / posts?.data.posts.per_page) ?? 1;

  return (
    <>
      <Helmet title="Início" />
      <div className="w-full flex flex-col justify-center items-center gap-4">
        {/* Cartão Padrão: Exibe a última publicação em destaque. */}
        <div className="bg-apae-white shadow-card-default !shadow-apae-dark/20 mt-[-50px] p-4 lg:flex lg:flex-nowrap flex-wrap w-[90%] lg:w-[80%]">
          <div className="h-[250px] lg:h-[200px] lg:max-w-[300px] flex justify-center ">
            <img
              className="h-full"
              src={`${app_settings.APP_URL}/images/photo-galery/sendThumb-e5b2923da39343f135dc521963b70bf7.jpeg`}
            />
          </div>

          {/* Início Exibição dos detalhes de um post. */}
          <DetailsPosts post={posts?.data.last_news} />
          {/* Final Exibição dos detalhes de um post. */}
        </div>
        {/* Final Cartão Padrão */}

        {/* Formulário de filtro */}
        <div className="w-[90%] lg:w-[80%]">
          <form onSubmit={handleSubmit(handleSearchSubmit)}>
            <div className="w-full relative">
              <input
                type="text"
                className="w-full h-[50px] bg-apae-gray-dark/10 rounded-md flex-1 border-2 pl-4 pr-[62px] shadow-md shadow-apae-dark/10"
                placeholder="Buscar publicação..."
                {...register('search')}
              />

              <button className="w-[60px] flex absolute top-0 right-0 h-full items-center justify-center rounded-r-md bg-apae-gray-dark/10">
                <Search size={24} className="text-apae-dark" />
              </button>
            </div>
          </form>
        </div>
        {/* Final Formulário de filtro */}

        {/* Listagem de Posts */}
        {posts?.data ? (
          <>
            <HomePosts posts={posts?.data} />
            <div className="w-[90%] lg:w-[80%] mb-10">
              {pages > 1 && (
                <Paginate className="">
                  <span className="text-[1rem]">
                    Total de {posts?.data.posts?.total} item(s)
                  </span>

                  <div className="controllers">
                    <span className="text-[1rem]">
                      Página {pageIndex} de {pages}
                    </span>

                    <div className="buttons">
                      <button
                        className="bg-apae-white shadow-md !shadow-apae-dark/20"
                        disabled={pageIndex === 1 || pageIndex === 0}
                        onClick={() => onChangePage(1)}
                      >
                        <ChevronsLeft className="h-6 w-6" />
                      </button>

                      <button
                        className="bg-apae-white shadow-md !shadow-apae-dark/20"
                        disabled={pageIndex === 1 || pageIndex === 0}
                        onClick={() => onChangePage(pageIndex - 1)}
                      >
                        <ChevronLeft className="h-6 w-6" />
                      </button>

                      <button
                        className="bg-apae-white shadow-md !shadow-apae-dark/20"
                        disabled={pages === pageIndex}
                        onClick={() => onChangePage(pageIndex + 1)}
                      >
                        <ChevronRight className="h-6 w-6" />
                      </button>

                      <button
                        className="bg-apae-white shadow-md !shadow-apae-dark/20"
                        disabled={pages === pageIndex}
                        onClick={() => onChangePage(pages)}
                      >
                        <ChevronsRight className="h-6 w-6" />
                      </button>
                    </div>
                  </div>
                </Paginate>
              )}
            </div>
          </>
        ) : (
          <div className="w-[80%] justify-center flex">
            <h2 className="text-[1.1rem] font-bold text-apae-gray-dark/80">
              Nenhuma públicação encontrada!
            </h2>
          </div>
        )}
        {/* Final Listagem de Posts */}
      </div>
    </>
  );
}
