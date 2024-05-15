import React, { useContext } from 'react';
import { Outlet } from 'react-router-dom';
import { ApaeBlogContext } from '../contexts/blog';

export function Blog() {
  const { app_settings } = useContext(ApaeBlogContext);
  return (
    <>
      <header className="text-apae-white bg-apae-teal h-[150px] flex justify-center items-center ">
        <div className="w-[95%] md:w-[80%] flex items-center justify-between">
          <div className="w-44 mt-[-40px]">
            <img
              className=""
              src={`${app_settings.APP_URL}/images/app/logo-branca.webp`}
            />
          </div>

          <nav>
            <ul className="flex items-center gap-4">
              <a href={`${app_settings.APP_URL}`}>
                <li>Ir para site...</li>
              </a>
            </ul>
          </nav>
        </div>
      </header>

      <Outlet />
    </>
  );
}
