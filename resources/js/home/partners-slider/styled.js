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

  .slide-item {
    border: 2px solid red;
    max-height: 200px;

    img {
      width: 100%;
      height: 100%;
    }
  }
`;
