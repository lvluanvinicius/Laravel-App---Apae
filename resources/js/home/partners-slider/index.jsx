import React from 'react';
import ReactSlick from 'react-slick';
import {
  PartnersSliderContainer,
  PartnersSliderContent,
  ReactSlickItem,
  PartnersSliderTitle,
} from './styled';

import 'slick-carousel/slick/slick.css';
import 'slick-carousel/slick/slick-theme.css';

const SOURCES_PARTNERS = `${import.meta.env.VITE_APP_URL}/images/partners/`;

export function PartnersSlider() {
  var settings = {
    dots: false,
    infinite: true,
    speed: 500,
    slidesToShow: 6,
    slidesToScroll: 1,
    initialSlide: 0,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 4,
          slidesToScroll: 1,
          infinite: true,
        },
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 1,
        },
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          arrows: false,
        },
      },
    ],
  };

  // const loadData = async () => {
  //   // await
  // };

  return (
    <PartnersSliderContainer>
      <PartnersSliderContent>
        <PartnersSliderTitle>
          <h2>
            Empresas <b>Parceiras</b>
          </h2>
        </PartnersSliderTitle>

        <ReactSlick {...settings} className="react-slick-component">
          <ReactSlickItem>
            <img
              src={`${SOURCES_PARTNERS}/Aramifício Chavantes-c537a201868ff1f4fd56b68621c25469.jpg`}
            />
          </ReactSlickItem>
        </ReactSlick>
      </PartnersSliderContent>
    </PartnersSliderContainer>
  );
}
