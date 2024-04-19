import React from 'react';
import { Card } from './Card';

export function HomePosts() {
  return (
    <div className="w-[90%] lg:w-[80%] mb-10">
      <div className="w-full grid grid-cols-2 md:grid-cols-2 gap-4">
        <div className="col-span-2 lg:col-span-1">
          <Card />
        </div>

        <div className="col-span-2 lg:col-span-1">
          <Card />
        </div>

        <div className="col-span-2 lg:col-span-1">
          <Card />
        </div>
      </div>
    </div>
  );
}
