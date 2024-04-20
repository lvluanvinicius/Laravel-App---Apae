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
          <div className="w-[80%] bg-apae-white mb-7 shadow-card-default shadow-apae-gray/40 mt-[-50px] h-full py-8 px-12 rounded-md flex flex-col gap-4">
            <div className="flex justify-between items-center border-b pb-2">
              <h1 className="font-bold text-[1.6rem]">Nome para o Post aqui</h1>
              <span>{dateExtFormatter('2022-06-30 14:22')}</span>
            </div>
            {post?.data ? (
              <div dangerouslySetInnerHTML={{ __html: cleanedContent }} />
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
