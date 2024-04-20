import React, { useContext } from 'react';
import { ApaeBlogContext } from '../../contexts/blog';
import { DetailsPosts } from '../DetailsPosts';

export function Card({ post }) {
  const { app_settings } = useContext(ApaeBlogContext);

  return (
    <div className="bg-apae-white shadow-card-default !shadow-apae-dark/20 p-4 lg:flex lg:flex-nowrap flex-wrap">
      <div className="h-[250px] lg:h-[200px] lg:max-w-[300px] flex justify-center ">
        <img
          className="h-full"
          src={`${app_settings.APP_URL}/images/photo-galery/sendThumb-e5b2923da39343f135dc521963b70bf7.jpeg`}
        />
      </div>

      {/* Início Exibição dos detalhes de um post. */}
      <DetailsPosts post={post} />
      {/* Final Exibição dos detalhes de um post. */}
    </div>
  );
}
