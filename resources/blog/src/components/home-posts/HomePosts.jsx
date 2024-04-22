import React from 'react';
import { Card } from './Card';

export function HomePosts({ posts }) {
  return (
    <div className="w-[90%] lg:w-[80%] mb-2">
      <div className="w-full grid grid-cols-2 md:grid-cols-2 gap-4">
        {posts?.posts.data.map((post) => (
          <div className="col-span-2 lg:col-span-2 xl:col-span-1" key={post.id}>
            <Card post={post} />
          </div>
        ))}
      </div>
    </div>
  );
}
