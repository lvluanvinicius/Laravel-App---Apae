import React from 'react';
import ReactDOM from 'react-dom/client';
import { UsersTable } from './components/users-table';

if (document.getElementById('users-root')) {
  ReactDOM.createRoot(document.getElementById('users-root')).render(
    <div className="mx-2 mt-4 md:mx-8">
      <div className="grid w-full grid-cols-12">
        <UsersTable />
      </div>
    </div>
  );
}
