import dayjs from 'dayjs';

export function getDateToday(){
  return dayjs().format('YYYY-MM-DD');
}