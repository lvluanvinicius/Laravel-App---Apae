import { useMutation } from '@tanstack/react-query';
import React from 'react';
import { useForm } from 'react-hook-form';
import { createPostsComment } from '../../services/queries/create-posts-comment';
import { useParams } from 'react-router-dom';
import { queryClient } from '../../services/react-query';

export function FormPostComment() {
  const { slug } = useParams();
  const { handleSubmit, register, reset } = useForm();

  const { mutateAsync: saveCommentFn } = useMutation({
    mutationFn: createPostsComment,
    onSuccess: () => {
      queryClient.invalidateQueries(['post-comments']);
      reset({
        name: '',
        email: '',
        comment: '',
      });
    },
  });

  async function handleSaveComment(data) {
    try {
      await saveCommentFn({ slug, data });

      console.log('Comentário criado com sucesso.');
    } catch {
      alert('Falha ao criar comentário, tente novamente');
    }
  }

  return (
    <div className="w-[95%] md:w-[80%] bg-apae-white shadow-card-default shadow-apae-gray/40 rounded-md p-4">
      <div className="mb-2">
        <h4 className="font-bold text-[1.1rem]">Novo Comentário</h4>
      </div>
      <form
        className="w-full flex flex-col gap-4"
        onSubmit={handleSubmit(handleSaveComment)}
      >
        <input
          type="text"
          className="bg-apae-dark/20 h-[50px] w-full rounded-md"
          placeholder="Nome *"
          {...register('name', { required: true })}
        />
        <input
          type="text"
          className="bg-apae-dark/20 h-[50px] w-full rounded-md"
          placeholder="E-mail"
          {...register('email')}
        />
        <textarea
          className="bg-apae-dark/20 resize-none w-full rounded-md"
          rows={5}
          placeholder="* Descreva seu comentário..."
          {...register('comment', { required: true })}
        ></textarea>

        <button
          type="submit"
          className=" bg-apae-teal text-apae-white px-2 w-full md:w-[200px] h-[40px] rounded-md text-[1rem]"
        >
          Comentar
        </button>
      </form>
    </div>
  );
}
