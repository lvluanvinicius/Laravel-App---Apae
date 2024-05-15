import { format, parseISO } from 'date-fns';
import { ptBR } from 'date-fns/locale';

export const dateExtFormatter = (date) => {
  return format(parseISO(date), `dd 'de' MMMM yyyy 'às' HH'h'mm`, {
    locale: ptBR,
  });
};
