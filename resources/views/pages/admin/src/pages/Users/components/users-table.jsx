import React from 'react';
import { getUsers } from '../../../services';
import { EditUser } from './users-edit';
import { CreateUser } from './users-create';

export function UsersTable() {
  const [users, setUsers] = React.useState([]);

  async function searchData() {
    try {
      const response = await getUsers();

      if (response.data) {
        setUsers(response.data);
      }
    } catch (error) {
      console.log(error);
    }
  }

  React.useEffect(() => {
    searchData();
  }, []);

  return (
    <div className="table-apae-content col-span-12 rounded bg-apae-white px-8 pb-8 pt-4 shadow-md dark:bg-apae-gray-dark">
      <div className="mb-4 flex w-full justify-between">
        <form>
          {/* <input
            placeholder="Buscar usuário..."
            className="!border !border-apae-gray-dark"
          /> */}
        </form>
        <CreateUser />
      </div>
      <table className="w-full bg-apae-white border-collapse">
        <thead>
          <tr>
            <td className="border-b-[2px] pb-2 font-bold">ID</td>
            <td className="border-b-[2px] pb-2 font-bold">Nome</td>
            <td className="border-b-[2px] pb-2 font-bold">E-mail</td>
            <td className="border-b-[2px] pb-2 font-bold">Tipo</td>
            <td className="border-b-[2px] pb-2 font-bold"></td>
          </tr>
        </thead>

        <tbody>
          {users?.data?.map((user) => {
            return (
              <tr key={user.id}>
                <td className="border-b-[2px] text-md pb-2 py-3">{user.id}</td>
                <td className="border-b-[2px] text-md pb-2 py-3">
                  {user.name}
                </td>
                <td className="border-b-[2px] text-md pb-2 py-3">
                  {user.email}
                </td>
                <td className="border-b-[2px] text-md pb-2 py-3">
                  {user.is_client ? 'Cliente' : 'Administrador'}
                </td>
                <td className="border-b-[2px] text-md pb-2 py-3">
                  <div className="">
                    <EditUser />
                  </div>
                </td>
              </tr>
            );
          })}
        </tbody>
      </table>
    </div>
  );
}
