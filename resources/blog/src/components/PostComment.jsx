import { useQuery } from '@tanstack/react-query';
import React from 'react';
import { useParams, useSearchParams } from 'react-router-dom';
import { getPostsComments } from '../services/queries/get-posts-comments';

export function PostComment() {
  const { slug } = useParams();
  const [searchParams] = useSearchParams();

  const pageIndex = searchParams.get('page')
    ? parseInt(searchParams.get('page'))
    : 1;

  const { data: postComments } = useQuery({
    queryKey: ['post-comments'],
    queryFn: () => getPostsComments({ slug, pageIndex }),
  });

  console.log();
  return (
    <div className="w-[95%] md:w-[80%] flex flex-col gap-4 mt-4 border-t pt-4 mb-10">
      {postComments?.data &&
        postComments.data?.data.map((comment) => {
          return (
            <div
              className="w-full bg-apae-white shadow-card-default shadow-apae-gray/40 p-4 rounded-md"
              key={comment.id}
            >
              <div className="flex flex-col gap-2">
                <div className="flex items-center gap-2 w-full">
                  <p className="font-semibold">{comment.name}</p>
                </div>
                <p className="text-sm w-full">{comment.comment}</p>
              </div>
            </div>
          );
        })}
    </div>
  );
}
