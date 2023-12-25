<x-admin.app-default app_title="" page_title="{{ $title }}">
    @section('content')
        <div class="mx-8 mt-4">

            <div class="mb-4 bg-apae-white p-6 text-apae-gray-dark shadow-md dark:bg-apae-gray-dark dark:text-apae-white">
                <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data"
                    class="grid grid-cols-2 gap-4" name="create_post_news">
                    @csrf

                    <div class="col-span-2 flex w-full flex-wrap">
                        <h1 class="text-[1.5rem] font-bold">Nova Notícia</h1>
                    </div>


                    <div class="col-span-2 flex w-full flex-wrap p-1 md:col-span-1">
                        <label for="news_post_title" class="w-full text-[1rem]">Nome do Post</label>
                        <input required type="text" id="news_post_title" name="news_post_title"
                            value="{{ old('news_post_title') }}"
                            class="w-full rounded-[4px] !border-none bg-apae-gray/10 px-2 py-1 !outline-none">
                    </div>

                    <div class="col-span-2 flex w-full flex-wrap p-1 md:col-span-1">
                        <label for="cod_category_fk" class="w-full text-[1rem]">Categoria</label>
                        <select required type="text" id="cod_category_fk" name="cod_category_fk"
                            value="{{ old('cod_category_fk') }}"
                            class="w-full rounded-[4px] !border-none bg-apae-gray/10 px-2 py-1 !outline-none">
                            <option value="">Selecione uma categoria</option>

                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->description }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-span-2 flex w-full flex-wrap p-1">
                        <label for="news_post_content" class="w-full text-[1rem]">Conteúdo</label>
                        {{-- <textarea required type="text" id="news_post_content" name="news_post_content"
                            class="w-full rounded-[4px] !border-none bg-apae-gray/10 px-2 py-1 !outline-none">
                        </textarea> --}}

                        <div id="news_post_content"
                            class="h-[100vh] w-full rounded-[4px] !border-none bg-apae-gray/10 px-2 py-1 !outline-none dark:!text-apae-white">
                        </div>
                    </div>

                    <div class="col-span-2 mt-10 flex w-full flex-wrap p-1 py-4">
                        <h3 class="text-[1.1rem] font-bold">Outras informações</h3>
                    </div>

                    <div class="col-span-2 flex w-full flex-wrap p-1">
                        <label for="news_post_summary" class="w-full text-[1rem]">Resumo</label>
                        <input required type="text" id="news_post_summary" name="news_post_summary"
                            value="{{ old('news_post_summary') }}"
                            class="w-full rounded-[4px] !border-none bg-apae-gray/10 px-2 py-1 !outline-none">
                    </div>

                    <div class="col-span-2 flex w-full flex-wrap p-1 md:col-span-1">
                        <label for="news_post_slug" class="w-full text-[1rem]">Slug (Nome amigável para URL)</label>
                        <input type="text" id="news_post_slug" name="news_post_slug" value="{{ old('news_post_slug') }}"
                            class="w-full rounded-[4px] !border-none bg-apae-gray/10 px-2 py-1 !outline-none">
                    </div>

                    <div class="col-span-2 flex w-full flex-wrap p-1 md:col-span-1">
                        <label for="news_post_tags" class="w-full text-[1rem]">Palavras Chaves (Opcional)</label>
                        <input type="text" id="news_post_tags" name="news_post_tags" value="{{ old('news_post_tags') }}"
                            class="w-full rounded-[4px] !border-none bg-apae-gray/10 px-2 py-1 !outline-none">
                    </div>

                    <div class="col-span-2 flex w-full flex-wrap justify-between gap-4 py-3">
                        <a href="{{ route('admin.news.index') }}"
                            class="rounded-sm bg-apae-green px-6 py-1 text-apae-white shadow-md dark:bg-apae-gray">
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
        <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

        <style>
            #news_post_content {}
        </style>
    @endsection

    @section('js-content')
        <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            var toolbarOptions = [
                ['bold', 'italic', 'underline', 'strike', 'image'],
                ['blockquote', 'code-block'],

                [{
                    'header': 1
                }, {
                    'header': 2
                }],
                [{
                    'list': 'ordered'
                }, {
                    'list': 'bullet'
                }],
                [{
                    'script': 'sub'
                }, {
                    'script': 'super'
                }],
                [{
                    'indent': '-1'
                }, {
                    'indent': '+1'
                }],
                [{
                    'direction': 'rtl'
                }],

                [{
                    'size': ['small', false, 'large', 'huge']
                }],
                [{
                    'header': [1, 2, 3, 4, 5, 6, false]
                }],

                [{
                    'color': []
                }, {
                    'background': []
                }],
                [{
                    'font': []
                }],
                [{
                    'align': []
                }],

                ['clean']
            ];
            var quill = new Quill('#news_post_content', {
                modules: {
                    toolbar: toolbarOptions
                },
                theme: 'snow'
            });

            document.getElementById('news_post_title').addEventListener('input', (event) => {
                const {
                    value
                } = event.target;

                document.getElementById('news_post_slug').value = value.toString().toLowerCase().replace(/\s+/g, '-')
                    .replace(/[^a-z-0-9]/g, '');
            })

            $('#cod_category_fk').val("{{ old('cod_category_fk') }}");

            $(document).ready(function() {
                $('#cod_category_fk').select2();
            });

            document.querySelector('form[name="create_post_news"]').addEventListener('submit', function (form) {
                form.preventDefault();

                // Criando inpur content.
                const news_post_content = document.createElement('input');
                news_post_content.value = quill.root.innerHTML;
                news_post_content.name = "news_post_content";

                form.target.appendChild(news_post_content);
                form.target.submit();
            });

            quill.root.innerHTML = `{{ old('news_post_content') }}`
        </script>
    @endsection
</x-admin.app-default>
