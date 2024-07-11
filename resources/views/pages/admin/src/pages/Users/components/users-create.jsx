import React from 'react';
import styled from 'styled-components';
import * as Dialog from '@radix-ui/react-alert-dialog';
import { colors } from '../../../../../../../../styles';
import { useForm } from 'react-hook-form';
import { createUser } from '../../../services';

const CreateUserRoot = styled(Dialog.Root)``;

const CreateUserTrigger = styled(Dialog.Trigger)`
  background-color: ${colors['apae-green']};
  color: ${colors['apae-white']};
  border-radius: 4px;
  width: 100px;
  padding: 2px 0;
  cursor: pointer !important;
`;

const CreateUserOverlay = styled(Dialog.Overlay)`
  position: absolute;
  background-color: ${colors['apae-dark']};
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  z-index: 99999;
  opacity: 0.5;
`;

const CreateUserContent = styled(Dialog.Content)`
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background-color: ${colors['apae-white']};
  z-index: 999999;
  box-shadow: 0 0 8px rgba(0, 0, 0, 0.5);

  min-width: 400px;
  min-height: 320px;
  padding: 1rem;

  display: flex;
  flex-direction: column;
  gap: 0.5rem;

  input,
  select {
    background-color: rgba(0, 0, 0, 0.1);
    font-weight: 500;
    width: 100%;
    height: 35px;
    border-radius: 4px;
    padding-left: 1rem;
  }

  button[type='button'],
  button[type='submit'] {
    background-color: ${colors['apae-green']};
    color: ${colors['apae-white']};
    height: 30px;
    min-width: 100px;
    font-size: 0.9rem;
    border-radius: 4px;
  }
`;

const CreateUserTitle = styled(Dialog.Title)`
  font-weight: bold;
  font-size: 1.2rem;
  opacity: 0.7;
  border-bottom: 1px solid ${colors['apae-dark']};
`;

export function CreateUser() {
  const [open, setOpen] = React.useState(false);

  const { handleSubmit, reset, register } = useForm({});

  function closeForm() {
    setOpen(false);
    reset();
  }

  async function handleCreateUser(data) {
    try {
      const create = await createUser(data);

      if (create.message) {
        alert(create.message);
        window.location.reload();
      }
    } catch (err) {
      const { data } = err.response;

      alert(data.message);
    }
  }

  return (
    <CreateUserRoot open={open} onOpenChange={setOpen}>
      <CreateUserTrigger>+Novo</CreateUserTrigger>

      <Dialog.Portal>
        <CreateUserOverlay />
        <CreateUserContent>
          <CreateUserTitle>Novo Usuário</CreateUserTitle>

          <form
            onSubmit={handleSubmit(handleCreateUser)}
            className="grid gap-4 grid-cols-2"
          >
            <div className="col-span-2">
              <input
                placeholder="Nome"
                type="text"
                {...register('name', { required: true })}
              />
            </div>
            <div className="col-span-2">
              <input
                placeholder="E-mail"
                type="email"
                {...register('email', { required: true })}
              />
            </div>
            <div className="col-span-2">
              <input
                placeholder="Senha"
                type="password"
                {...register('password', { required: true })}
              />
            </div>
            <div className="col-span-2">
              <select
                className=""
                {...register('is_client', { required: true })}
              >
                <option value={0}>Usuário Interno</option>
                <option value={1}>Cliente/Usuário</option>
              </select>
            </div>
            <div className="col-span-2">
              <select className="" {...register('rule', { required: true })}>
                <option value="" selected>
                  Selecione uma Regra
                </option>
                <option value="admin">Administrador</option>
                <option value="user">Colaborador</option>
              </select>
            </div>
            <div className="col-span-2 flex justify-between items-center">
              <button type="button" className="" onClick={closeForm}>
                Cancelar
              </button>
              <button type="submit" className="">
                Criar
              </button>
            </div>
          </form>
        </CreateUserContent>
      </Dialog.Portal>
    </CreateUserRoot>
  );
}
