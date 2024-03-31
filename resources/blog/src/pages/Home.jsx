import React, { useContext } from 'react';
import { Helmet } from 'react-helmet-async';
import { ApaeBlogContext } from '../contexts/blog';
import { Search } from 'lucide-react';
import { HomePosts } from '../components/home-posts/HomePosts';
import { DetailsPosts } from '../components/DetailsPosts';

export function Home() {
  const { app_settings } = useContext(ApaeBlogContext);
  return (
    <>
      <Helmet title="Início" />
      <div className="w-full flex flex-col items-center gap-4">
        {/* Cartão Padrão: Exibe a última publicação em destaque. */}
        <div className="w-[80%] mt-[-50px] h-[250px] py-2 px-6 shadow-card-default shadow-apae-gray-dark/30 rounded-xl bg-apae-white">
          <div className="flex justify-between h-full flex-wrap">
            <div className="-max-w-[350px] h-full object-fill">
              <img
                className="h-full"
                src={`${app_settings.APP_URL}/images/photo-galery/sendThumb-e5b2923da39343f135dc521963b70bf7.jpeg`}
              />
            </div>

            {/* Início Exibição dos detalhes de um post. */}
            <DetailsPosts />
            {/* Final Exibição dos detalhes de um post. */}
          </div>
        </div>
        {/* Final Cartão Padrão */}

        {/* Formulário de filtro */}
        <div className="w-[80%]">
          <form>
            <div className="w-full relative">
              <input
                type="text"
                className="w-full h-[50px] bg-apae-gray-dark/10 rounded-md flex-1 border-2 pl-4 pr-[62px] shadow-md shadow-apae-dark/10"
                placeholder="Buscar publicação..."
              />

              <button className="w-[60px] flex absolute top-0 right-0 h-full items-center justify-center rounded-r-md bg-apae-gray-dark/10">
                <Search size={24} className="text-apae-dark" />
              </button>
            </div>
          </form>
        </div>
        {/* Final Formulário de filtro */}

        {/* Listagem de Posts */}
        <HomePosts />
        {/* Final Listagem de Posts */}
      </div>
    </>
  );
}
