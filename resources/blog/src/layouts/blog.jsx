import React, { useContext } from 'react';
import { Outlet } from 'react-router-dom';
import { ApaeBlogContext } from '../contexts/blog';

export function Blog() {
  const { app_settings } = useContext(ApaeBlogContext);
  return (
    <>
      <header className="text-apae-white bg-apae-teal  h-[150px] flex justify-center items-center">
        <nav className="">
          <div className="w-44 mt-[-40px]">
            <img
              className=""
              src={`${app_settings.APP_URL}/images/app/logo-branca.webp`}
            />
          </div>
        </nav>
      </header>

      <Outlet />
    </>
  );
}
