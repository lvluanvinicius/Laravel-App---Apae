import styled from 'styled-components';
import { colors } from '../../../../styles';

export const PartnersSliderContainer = styled.div`
  display: flex;
  justify-content: center;
  width: 100%;
  padding: 3rem 0 6rem 0;
  background-color: ${colors['apae-white']};
`;

export const PartnersSliderContent = styled.div`
  width: 90%;

  .slick-next,
  .slick-prev {
    &::before {
      color: ${colors['apae-orange']};
      font-size: 1.5rem;
    }
  }
`;

export const PartnersSliderTitle = styled.div`
  width: 100%;
  display: flex;
  justify-content: center;
  margin-bottom: 4rem;

  h2 {
    font-size: 2rem;
    border-bottom: 5px solid ${colors['apae-orange']};

    b {
      font-style: italic;
      font-weight: 600;
    }
  }

  @media (max-width: 480px) {
    margin-bottom: 2rem;
    h2 {
      font-size: 1.5rem;
    }
  }
`;

export const PartnersSliderItems = styled.div`
  display: flex;
  gap: 1rem;

  [class^='slide-item'],
  [class*=' slide-item'] {
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 50px;
    color: #fff;
    font-weight: 500;
    height: 100px;
    max-height: 100vh;
  }

  .slide-item {
    /* max-width: 200px !important;
    max-height: 200px !important; */

    img {
      /* width: 100%;
      height: 100%; */
    }
  }
`;
