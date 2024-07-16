import React, { useEffect, useState } from 'react';
import {
  PartnersSliderContainer,
  PartnersSliderContent,
  PartnersSliderTitle,
  PartnersSliderItems,
} from './styled';
import { useKeenSlider } from 'keen-slider/react';

import 'keen-slider/keen-slider.min.css';
import { api } from '../../services';

const animation = { duration: 20000, easing: (t) => t };

export function PartnersSlider() {
  const [partners, setPartners] = useState([]);
  const [isLoading, setIsLoading] = useState(true);

  const [sliderRef] = useKeenSlider({
    loop: true,
    renderMode: 'performance',
    drag: false,
    slides: {
      perView: 4,
    },
    created(s) {
      s.moveToIdx(5, true, animation);
    },
    updated(s) {
      s.moveToIdx(s.track.details.abs + 5, true, animation);
    },
    animationEnded(s) {
      s.moveToIdx(s.track.details.abs + 5, true, animation);
    },
  });

  async function loadSliders() {
    setIsLoading(true);
    const response = await api.get('website/partners-slider');
    if (!response.data) return null;
    const { data } = response.data;

    setPartners(data);
    setIsLoading(false);
  }

  useEffect(() => {
    loadSliders();
  }, []);

  if (isLoading) {
    return null;
  }

  return (
    <PartnersSliderContainer>
      <PartnersSliderContent>
        <PartnersSliderTitle>
          <h2>
            Empresas <b>Parceiras</b>
          </h2>
        </PartnersSliderTitle>
        <PartnersSliderItems ref={sliderRef} className="keen-slider">
          {partners.map((partner) => {
            return (
              <div key={partner.id} className="keen-slider__slide slide-item">
                <img
                  src={partner.partner_image}
                  alt=""
                  width={100}
                  height={100}
                />
              </div>
            );
          })}
        </PartnersSliderItems>
      </PartnersSliderContent>
    </PartnersSliderContainer>
  );
}
