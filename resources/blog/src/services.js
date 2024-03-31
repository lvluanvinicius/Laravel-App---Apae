import axios from 'axios';

export const app = axios.create({
  baseURL: `${import.meta.env.VITE_APP_URL}/api/blog`,
  headers: {
    Accept: 'application/json',
    'Content-Type': 'application/json',
  },
});

// app.get('').then(function (response) {
//   //   console.log(response);
// });
