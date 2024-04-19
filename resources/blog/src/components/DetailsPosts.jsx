import React from 'react';
import { Link } from 'react-router-dom';
import { ExternalLink, Eye, MessageSquare } from 'lucide-react';
import { dateExtFormatter } from '../utils/formatter';

export function DetailsPosts() {
  return (
    <div className="flex-1 h-full justify-between flex flex-col mt-4 lg:mt-0 gap-4 px-2 lg:px-8">
      <div className="w-full flex justify-between lg:flex-nowrap flex-wrap">
        <h1 className="font-bold w-full lg:w-[70%] text-[.8rem] lg:text-[.9rem] ">
          FESTA JUNINA - 2022
        </h1>
        <Link
          to={''}
          className="flex items-center gap-2 font-bold text-apae-dark/90"
        >
          <span className="text-[.6rem] lg:text-[.8rem]">VER PUBLICAÇÂO</span>
          <ExternalLink size={16} />
        </Link>
      </div>

      <div className={`w-full flex-1`}>
        <p
          className="text-justify text-[.8rem] lg:text-[1rem]"
          style={{
            whiteSpace: 'warp',
            overflow: 'hidden',
            textOverflow: 'ellipsis',
          }}
        >
          Evento: APAE de Chavantes tem o gosto pelas festas juninas, com o
          objetivo de proporcionar para os nossos atendidos, descontração,
          socialização e ampliação de seu conhecimento através de atividades
          diversificadas, brincadeiras, pesquisas, apresentações, comidas
          típicas e muito mais. Eles amam!
        </p>
      </div>

      <div className="w-full">
        <div className="flex justify-between text-sm font-semibold flex-wrap">
          <span className="flex gap-2 text-[12px]">
            <span className="flex items-center gap-1 w-[100px]">
              <Eye size={16} /> 10 views
            </span>
            <span className="flex items-center gap-1 w-[130px]">
              <MessageSquare size={16} /> 10 comentários
            </span>
          </span>

          <small>Publicado em: {dateExtFormatter('2022-06-30 14:22')}</small>
        </div>
      </div>
    </div>
  );
}
