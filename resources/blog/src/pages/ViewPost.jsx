import React, { useState } from 'react';
import { PostComment } from '../components/PostComment';
import { dateExtFormatter } from '../utils/formatter';
import { FormPostComment } from '../components/comments/post-form-comments';
import { useQuery } from '@tanstack/react-query';
import { useParams } from 'react-router-dom';
import { getPostView } from '../services/queries/get-post-view';
import DOMPurify from 'dompurify';

import { FacebookIcon, FacebookShareButton } from 'react-share';
import { FaceMask, FacebookLogo, ShareNetwork } from '@phosphor-icons/react';

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

  const [postUrl] = useState(function () {
    return document.location.href;
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
              <div className="w-full text-[14px] flex items-center just gap-2">
                <span className="text-[12px]">
                  Publicado em {dateExtFormatter(post?.data?.created_at)}
                </span>
              </div>
            </div>
            {post?.data ? (
              <div
                className=""
                dangerouslySetInnerHTML={{ __html: cleanedContent }}
              />
            ) : (
              <h1>Conteúdo não carregado!</h1>
            )}

            <div className="flex gap-4 flex-col flex-wrap">
              <div className="w-full">
                <span className="font-semibold !text-[1.1rem]">
                  Compartilhar
                </span>
              </div>
              <div className="flex items-center gap-1 ">
                <FacebookShareButton url={postUrl}>
                  <span className="bg-apae-primary text-apae-white px-3 py-1 rounded-md flex items-center gap-1">
                    <ShareNetwork size={16} weight="bold" /> Facebook
                  </span>
                </FacebookShareButton>
              </div>
            </div>
          </div>

          <FormPostComment />
          <PostComment />
        </>
      )}
    </div>
  );
}
