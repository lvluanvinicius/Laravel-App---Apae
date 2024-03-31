import React from 'react';
import { Card } from './Card';

export function HomePosts() {
  return (
    <div className="w-[80%]">
      <div className="w-full grid grid-cols-1 md:grid-cols-2 gap-4">
        <div className="col-span-1">
          <Card />
        </div>

        <div className="col-span-1">
          <Card />
        </div>

        <div className="col-span-1">
          <Card />
        </div>

        <div className="col-span-1">
          <Card />
        </div>

        <div className="col-span-1">
          <Card />
        </div>

        <div className="col-span-1">
          <Card />
        </div>

        <div className="col-span-1">
          <Card />
        </div>

        <div className="col-span-1">
          <Card />
        </div>

        <div className="col-span-1">
          <Card />
        </div>
      </div>
    </div>
  );
}
