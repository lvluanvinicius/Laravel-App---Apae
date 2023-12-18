<x-admin.app-default app_title="" page_title="{{ $title }}">
    @section('content')
        <div class="mx-8 mt-4">

            <div class="bg-apae-white p-6 text-apae-gray-dark shadow-md dark:bg-apae-gray-dark dark:text-apae-white ">
                <form action="{{ '' }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="flex w-full flex-wrap p-1">
                        <label for="" class="w-full text-[1rem]">Descrição</label>
                        <input type="text" id="" name="" value=""
                            class="w-full rounded-[4px] !border-none bg-apae-gray/10 px-2 py-1 !outline-none">
                    </div>

                    <div class="flex w-full flex-wrap p-1 ">
                        <label for="content" class="w-full text-[1rem]">Conteúdo</label>
                        <textarea type="text" id="content" name="content"
                            class="w-full rounded-[4px] !border-none bg-apae-gray/10 px-2 py-1 !outline-none">
                        </textarea>
                    </div>


                    <div class="flex w-full flex-wrap justify-center gap-4 py-3">
                        <button type="submit"
                            class="w-full rounded-sm bg-apae-green px-6 py-1 text-apae-white shadow-md dark:bg-apae-gray">
                            Salvar
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
        CKEDITOR.replace('content', {
            width: '100%',
        });
    </script>
    @endsection
</x-admin.app-default>
