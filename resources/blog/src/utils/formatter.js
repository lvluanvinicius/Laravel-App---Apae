import { format, parseISO } from 'date-fns';

export const dateExtFormatter = (date) => {
  return format(parseISO(date), `dd MMM yyyy 'às' HH'h'mm`);
};
