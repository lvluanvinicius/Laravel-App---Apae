import React from 'react';
import { Link } from 'react-router-dom';
import { ExternalLink, Eye, MessageSquare } from 'lucide-react';

export function DetailsPosts({ post }) {
  return (
    <div className="flex-1 justify-between flex flex-col mt-4 lg:mt-0 gap-4 px-2 lg:px-8">
      <div className="flex-1">
        <div className="w-full flex justify-between lg:flex-nowrap flex-wrap">
          <h1 className="font-bold w-full lg:w-[70%] text-[.8rem] lg:text-[.9rem] ">
            {post?.news_post_title}
          </h1>
          <Link
            to={`/blog/${post?.news_post_slug}`}
            className="flex items-center gap-2 font-bold text-apae-dark/90"
          >
            <span className="text-[.6rem] lg:text-[.8rem]">VER PUBLICAÇÂO</span>
            <ExternalLink size={16} />
          </Link>
        </div>

        <div className="w-full flex-1">
          <p
            className="text-justify text-[.8rem] lg:text-[1rem]"
            style={{
              whiteSpace: 'warp',
              overflow: 'hidden',
              textOverflow: 'ellipsis',
            }}
          >
            {post?.news_post_summary}
          </p>
        </div>
      </div>

      <div className="w-full">
        <div className="flex justify-between text-sm font-semibold flex-wrap">
          <span className="flex gap-2 text-[12px]">
            <span className="flex items-center gap-1 w-[100px]">
              <Eye size={16} /> {post?.news_post_status} views
            </span>
            <span className="flex items-center gap-1 w-[130px]">
              <MessageSquare size={16} /> 10 comentários
            </span>
          </span>

          <small>
            Publicado{' '}
            {new Date(post?.created_at).toLocaleDateString('pt-BR', {
              day: '2-digit',
              month: '2-digit',
              year: 'numeric',
            })}
          </small>
        </div>
      </div>
    </div>
  );
}
