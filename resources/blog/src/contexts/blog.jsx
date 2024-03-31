import React, { createContext } from 'react';

export const ApaeBlogContext = createContext({});

export function ApaeBlogContextProvider({ children }) {
  const [app_settings] = React.useState(function () {
    return { APP_URL: `${import.meta.env.VITE_APP_URL}` };
  });

  return (
    <ApaeBlogContext.Provider value={{ app_settings }}>
      {children}
    </ApaeBlogContext.Provider>
  );
}
