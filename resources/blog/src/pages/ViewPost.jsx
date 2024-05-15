import React from 'react';
import { PostComment } from '../components/PostComment';
import { dateExtFormatter } from '../utils/formatter';
import { FormPostComment } from '../components/comments/post-form-comments';
import { useQuery } from '@tanstack/react-query';
import { useParams } from 'react-router-dom';
import { getPostView } from '../services/queries/get-post-view';
import DOMPurify from 'dompurify';

export function ViewPost() {
  const { slug } = useParams();
  const {
    data: post,
    isError,
    isLoading,
  } = useQuery({
    queryKey: ['post-view'],
    queryFn: () => getPostView(slug),
  });

  if (isError || !post) {
    return <div>Erro ao carregar o post...</div>;
  }

  const cleanedContent = DOMPurify.sanitize(post?.data?.news_post_content);

  return (
    <div className="w-full flex justify-center flex-col items-center">
      {isLoading ? (
        <div>Carregando...</div>
      ) : (
        <>
          <div className="w-[95%] md:w-[80%] bg-apae-white mb-7 shadow-card-default shadow-apae-gray/40 mt-[-50px] h-full py-8 px-4 md:px-12 rounded-md flex flex-col gap-4">
            <div className="flex justify-between items-center flex-wrap  border-b pb-2">
              <h1 className="w-full font-bold md:text-[1.6rem]">
                {post?.data?.news_post_title}
              </h1>
              <div className="w-full text-[14px] flex items-center gap-2">
                <span className="text-[12px]">
                  Publicado em {dateExtFormatter(post?.data?.created_at)}
                </span>
              </div>
            </div>
            {post?.data ? (
              <div
                className="text-justify md:text-[1rem] text-[14px]"
                dangerouslySetInnerHTML={{ __html: cleanedContent }}
              />
            ) : (
              <h1>Conteúdo não carregado!</h1>
            )}
          </div>

          <FormPostComment />
          <PostComment />
        </>
      )}
    </div>
  );
}
