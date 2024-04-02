import React, { useEffect, useRef, useState } from 'react';
import {
  EditorNewPostContainer,
  EditorNewPostContent,
  EditorQuill,
  EditorNewPostFormGroup,
} from './styled';
import { useForm, Controller } from 'react-hook-form';

import { getCategories, savePost, getPhotoGallery } from '../../services';

export function EditorNewPost() {
  const { handleSubmit, control, register, setValue, reset } = useForm();
  const [categories, setCategories] = useState([]);
  const [galleries, setGalleries] = useState([]);
  const [auxStringGallery, setAuxStringGalery] = useState('');

  // Editor ref
  const quill = useRef();

  const modules = {
    toolbar: {
      container: [
        [{ header: [2, 3, 4, false] }],
        ['bold', 'italic', 'underline', 'blockquote'],
        [{ color: [] }],
        [
          { list: 'ordered' },
          { list: 'bullet' },
          { indent: '-1' },
          { indent: '+1' },
        ],
        ['link', 'image'],
        ['clean'],
      ],
    },
    clipboard: {
      matchVisual: true,
    },
  };

  const formats = [
    'header',
    'bold',
    'italic',
    'underline',
    'strike',
    'blockquote',
    'list',
    'bullet',
    'indent',
    'link',
    'image',
    'color',
    'clean',
  ];

  async function loadCategories() {
    try {
      const response = await getCategories();

      setCategories(response);
    } catch (e) {
      alert(e.message);
    }
  }

  async function loadPhotoGallery() {
    try {
      const response = await getPhotoGallery();

      setGalleries(response.data.data);
    } catch (e) {
      alert(e.message);
    }
  }

  function setSlugValue(value) {
    setValue(
      'news_post_slug',
      value
        .toString()
        .toLowerCase()
        .replace(/\s+/g, '-')
        .replace(/[^a-z-0-9]/g, '')
    );
  }

  async function handleSavePost(data) {
    try {
      const response = await savePost(data);

      if (response && response.status) {
        alert(response.message);
        reset();
        window.location.href = `${import.meta.env.VITE_APP_URL}/admin/news`;
      } else {
        response && new Error(response.message);
      }
    } catch (e) {
      alert(e.message);
    }
  }

  useEffect(() => {
    loadCategories();
  }, []);

  useEffect(() => {
    loadPhotoGallery();
  }, [auxStringGallery]);

  return (
    <EditorNewPostContainer>
      <EditorNewPostContent className="mx-8 mb-10 mt-4">
        <form
          onSubmit={handleSubmit(handleSavePost)}
          className="bg-apae-white text-apae-gray-dark dark:bg-apae-gray-dark dark:text-apae-white"
        >
          <div className="flex gap-4">
            <EditorNewPostFormGroup className="flex flex-wrap w-full">
              <label htmlFor="news_post_title" className="w-full text-[1rem]">
                Nome do Post
              </label>
              <input
                required
                type="text"
                id="news_post_title"
                onInput={(e) => setSlugValue(e.target.value)}
                className="w-full rounded-[4px] !border-none bg-apae-gray/10 px-2 py-1 !outline-none"
                {...register('news_post_title', {
                  required: 'Campo obrigatório.',
                })}
              />
            </EditorNewPostFormGroup>

            <EditorNewPostFormGroup className="flex flex-wrap w-full">
              <label htmlFor="cod_category_fk" className="w-full text-[1rem]">
                Categoria
              </label>

              <select
                {...register('cod_category_fk', {
                  required: 'Campo obrigatório.',
                })}
                id="cod_category_fk"
                className="w-full rounded-[4px] !border-none bg-apae-gray/10 px-2 py-1 !outline-none"
              >
                <option value={''}>Selecione...</option>
                {categories.map((item) => {
                  return (
                    <option value={item.id} key={item.id}>
                      {item.category} - {item.description}
                    </option>
                  );
                })}
              </select>
            </EditorNewPostFormGroup>
          </div>

          <EditorNewPostFormGroup className="w-full">
            <Controller
              control={control}
              name="news_post_content"
              rules={{ required: 'Campo obrigatório.' }}
              render={({ field: { onChange, value } }) => {
                return (
                  <EditorQuill
                    ref={(el) => (quill.current = el)}
                    theme="snow"
                    value={value}
                    formats={formats}
                    onChange={onChange}
                    modules={modules}
                  />
                );
              }}
            />
          </EditorNewPostFormGroup>

          <div className="flex gap-4">
            <EditorNewPostFormGroup className="flex flex-wrap w-full">
              <label htmlFor="news_post_summary" className="w-full text-[1rem]">
                Resumo
              </label>
              <input
                required
                type="text"
                id="news_post_summary"
                className="w-full rounded-[4px] !border-none bg-apae-gray/10 px-2 py-1 !outline-none"
                {...register('news_post_summary', {
                  required: 'Campo obrigatório.',
                })}
              />
            </EditorNewPostFormGroup>

            <EditorNewPostFormGroup className="flex flex-wrap w-full">
              <label htmlFor="news_post_slug" className="w-full text-[1rem]">
                Slug (Nome amigável para URL)
              </label>
              <input
                required
                type="text"
                id="news_post_slug"
                className="w-full rounded-[4px] !border-none bg-apae-gray/10 px-2 py-1 !outline-none"
                {...register('news_post_slug', {
                  required: 'Campo obrigatório.',
                })}
              />
            </EditorNewPostFormGroup>
          </div>

          <EditorNewPostFormGroup className="flex flex-wrap w-full">
            <label htmlFor="news_post_tags" className="w-full text-[1rem]">
              Palavras Chaves (Opcional)
            </label>
            <input
              required
              type="text"
              id="news_post_tags"
              className="w-full rounded-[4px] !border-none bg-apae-gray/10 px-2 py-1 !outline-none"
              {...register('news_post_tags')}
            />
          </EditorNewPostFormGroup>

          <EditorNewPostFormGroup className="flex flex-wrap w-full">
            <label
              htmlFor="cod_photo_gallery_fk"
              className="w-full text-[1rem]"
            >
              Galeria de Fotos (Opcional)
            </label>
            <input
              required
              list={`galleries-datalist`}
              type="text"
              onInput={(e) => setAuxStringGalery(e.target.value)}
              id="cod_photo_gallery_fk"
              className="w-full rounded-[4px] !border-none bg-apae-gray/10 px-2 py-1 !outline-none"
              {...register('cod_photo_gallery_fk')}
            />
            <datalist id={`galleries-datalist`}>
              {galleries &&
                galleries.map((item) => {
                  return (
                    <option
                      value={`${item.id} - ${item.gallery_name}`}
                      key={item.id}
                    ></option>
                  );
                })}
            </datalist>
          </EditorNewPostFormGroup>

          <EditorNewPostFormGroup className="flex gap-4">
            <a
              href={`${import.meta.env.VITE_APP_URL}/admin/news`}
              className="rounded-sm bg-apae-green px-6 py-1 text-apae-white shadow-md dark:bg-apae-gray"
            >
              Cancelar
            </a>
            <button
              type="submit"
              className="rounded-sm bg-apae-green px-6 py-1 text-apae-white shadow-md dark:bg-apae-gray"
            >
              Criar
            </button>
          </EditorNewPostFormGroup>
        </form>
      </EditorNewPostContent>
    </EditorNewPostContainer>
  );
}
