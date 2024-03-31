import React from 'react';

export function PostComment() {
  return (
    <div className="flex flex-col gap-4 mt-4 border-t pt-4">
      <div className="w-full">
        <h2 className="text-[1.2rem] font-bold">Comentários</h2>
      </div>
      <form className="w-full flex flex-col gap-4">
        <input
          type="text"
          className="bg-apae-dark/20 h-[50px] w-full rounded-md"
          placeholder="Nome *"
        />
        <input
          type="text"
          className="bg-apae-dark/20 h-[50px] w-full rounded-md"
          placeholder="E-mail *"
        />
        <textarea
          className="bg-apae-dark/20 resize-none w-full rounded-md"
          rows={5}
          placeholder="* Descreva seu comentário..."
        ></textarea>

        <button
          type="submit"
          className="bg-apae-teal text-apae-white px-2 w-[200px] h-[40px] rounded-md text-[1rem]"
        >
          Comentar
        </button>
      </form>
    </div>
  );
}
