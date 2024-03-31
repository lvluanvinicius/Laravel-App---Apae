import React, { useEffect, useState } from 'react';
import { ViewContainer } from './styled';
import { getPhotosFiles } from '../services';

export function View() {
  const [gallery, setGallery] = useState([]);

  async function fetchData() {
    const response = await getPhotosFiles('1');
    console.log(response);
    setGallery(response.data);
  }

  useEffect(() => {
    fetchData();
  }, []);

  return (
    <ViewContainer className="flex flex-wrap flex-col gap-4">
      <div className="bg-apae-white shadow-md shadow-apae-dark/10 p-4 w-full">
        <h1>O dia nacional de café.</h1>
      </div>

      <div className="bg-apae-white shadow-md shadow-apae-dark/10 p-4 w-full">
        Fotos
      </div>
    </ViewContainer>
  );
}
