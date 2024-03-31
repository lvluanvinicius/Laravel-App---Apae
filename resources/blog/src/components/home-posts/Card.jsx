import React, { useContext } from 'react';
import { ApaeBlogContext } from '../../contexts/blog';
import { DetailsPosts } from '../DetailsPosts';

export function Card() {
  const { app_settings } = useContext(ApaeBlogContext);

  return (
    <div className="bg-apae-white shadow-card-default !shadow-apae-dark/20 p-4 flex flex-nowrap">
      <div className="h-[200px] max-w-[300px]">
        <img
          className="h-full"
          src={`${app_settings.APP_URL}/images/photo-galery/sendThumb-e5b2923da39343f135dc521963b70bf7.jpeg`}
        />
      </div>

      {/* Início Exibição dos detalhes de um post. */}
      <DetailsPosts />
      {/* Final Exibição dos detalhes de um post. */}
    </div>
  );
}
