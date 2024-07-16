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

const ResizePlugin = (slider) => {
  const observer = new ResizeObserver(function () {
    slider.update();
  });

  slider.on('created', () => {
    observer.observe(slider.container);
  });
  slider.on('destroyed', () => {
    observer.unobserve(slider.container);
  });
};

export function PartnersSlider() {
  const [partners, setPartners] = useState([]);
  const [isLoading, setIsLoading] = useState(true);
  const [slidesPerView, setSlidesPerView] = useState(4);

  const updateSlidesPerView = () => {
    const width = window.innerWidth;
    if (width < 600) {
      setSlidesPerView(3);
    } else if (width < 900) {
      setSlidesPerView(4);
    } else if (width < 1200) {
      setSlidesPerView(6);
    } else {
      setSlidesPerView(8);
    }
  };

  useEffect(() => {
    updateSlidesPerView();
    window.addEventListener('resize', updateSlidesPerView);
    return () => window.removeEventListener('resize', updateSlidesPerView);
  }, []);

  const [sliderRef] = useKeenSlider(
    {
      loop: true,
      renderMode: 'performance',
      drag: false,
      slides: {
        perView: slidesPerView,
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
    },
    [ResizePlugin]
  );

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
                  alt={partner.partner_name}
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
