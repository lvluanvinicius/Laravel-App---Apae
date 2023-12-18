<x-admin.app-default app_title="" page_title="{{ $title }}">
    @section('content')
        <div class="mx-8 mt-4">

            <div class="mb-4 bg-apae-white p-6 text-apae-gray-dark shadow-md dark:bg-apae-gray-dark dark:text-apae-white">
                <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-2 gap-4">
                    @csrf

                    <div class="flex w-full flex-wrap col-span-2">
                        <h1 class="text-[1.5rem] font-bold">Nova Notícia</h1>
                    </div>


                    <div class="flex w-full flex-wrap p-1 col-span-2 md:col-span-1">
                        <label for="news_post_title" class="w-full text-[1rem]">Nome do Post</label>
                        <input required type="text" id="news_post_title" name="news_post_title"
                            value="{{ old('news_post_title') ? old('news_post_title') : $news->news_post_title }}"
                            class="w-full rounded-[4px] !border-none bg-apae-gray/10 px-2 py-1 !outline-none">
                    </div>

                    <div class="flex w-full flex-wrap p-1 col-span-2 md:col-span-1">
                        <label for="cod_category_fk" class="w-full text-[1rem]">Categoria</label>
                        <select required type="text" id="cod_category_fk" name="cod_category_fk"
                            class="w-full rounded-[4px] !border-none bg-apae-gray/10 px-2 py-1 !outline-none cursor-pointer">
                            <option value="">Selecione uma categoria</option>

                            @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->description}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex w-full flex-wrap p-1  col-span-2">
                        <label for="news_post_content" class="w-full text-[1rem]">Conteúdo</label>
                        <textarea required type="text" id="news_post_content" name="news_post_content"
                            class="w-full rounded-[4px] !border-none bg-apae-gray/10 px-2 py-1 !outline-none">
                        </textarea>
                    </div>

                    <div class="flex w-full flex-wrap p-1 py-4 col-span-2">
                        <h3 class="text-[1.1rem] font-bold">Outras informações</h3>
                    </div>

                    <div class="flex w-full flex-wrap p-1 col-span-2">
                        <label for="news_post_summary" class="w-full text-[1rem]">Sumário</label>
                        <input required type="text" id="news_post_summary" name="news_post_summary"
                            value="{{ old('news_post_summary') ? old('news_post_summary') : $news->news_post_summary }}"
                            class="w-full rounded-[4px] !border-none bg-apae-gray/10 px-2 py-1 !outline-none">
                    </div>

                    <div class="flex w-full flex-wrap p-1 col-span-2 md:col-span-1">
                        <label for="news_post_slug" class="w-full text-[1rem]">Slug (Nome amigável para URL)</label>
                        <input type="text" id="news_post_slug" name="news_post_slug"
                            value="{{ old('news_post_slug') ? old('news_post_slug') : $news->news_post_slug }}"
                            class="w-full rounded-[4px] !border-none bg-apae-gray/10 px-2 py-1 !outline-none">
                    </div>                    

                    <div class="flex w-full flex-wrap p-1 col-span-2 md:col-span-1">
                        <label for="news_post_tags" class="w-full text-[1rem]">Palavras Chaves (Opcional)</label>
                        <input type="text" id="news_post_tags" name="news_post_tags" 
                            value="{{ old('news_post_tags') ? old('news_post_tags') : $news->news_post_tags }}"
                            class="w-full rounded-[4px] !border-none bg-apae-gray/10 px-2 py-1 !outline-none">
                    </div>

                    <div class="col-span-2 flex w-full flex-wrap justify-between gap-4 py-3">
                        <a href="{{ route('admin.news.index') }}"
                            class=" rounded-sm bg-apae-green px-6 py-1 text-apae-white shadow-md dark:bg-apae-gray">
                            Cancelar
                        </a>
                        <button type="submit"
                            class="rounded-sm bg-apae-green px-6 py-1 text-apae-white shadow-md dark:bg-apae-gray">
                            Criar
                        </button>
                    </div>

                </form>
            </div>

        </div>
    @endsection

    @section('head')
        <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    @endsection

    @section('js-content')
        <script>
            CKEDITOR.replace('news_post_content', {
                width: '100%',
            });

            $('#news_post_content').val(`{{ old('news_post_content') }}`);

            document.getElementById('news_post_title').addEventListener('input', (event) => {
                const {
                    value
                } = event.target;

                document.getElementById('news_post_slug').value = value.toString().toLowerCase().replace(/\s+/g, '-')
                    .replace(/[^a-z-0-9]/g, '');
            });

            $('#cod_category_fk').val("{{ old('cod_category_fk') ? old('cod_category_fk') : $news->cod_category_fk }}");
        </script>
    @endsection
</x-admin.app-default>
