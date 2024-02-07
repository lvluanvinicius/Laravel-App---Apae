<x-admin.app-default app_title="" page_title="{{ $title }}">
    @section('content')
        <div class="mx-8 mt-4">
            <div class="w-full">

                <div
                    class="mb-4 bg-apae-white p-6 text-apae-gray-dark shadow-md dark:bg-apae-gray-dark dark:text-apae-white">
                    <form action="{{ route('admin.news.categories.update', ['categoryId' => $category->id]) }}" method="POST" enctype="multipart/form-data"
                        class="grid grid-cols-2 gap-4">
                        @csrf
                        @method('PUT')
                        <div class="col-span-2 flex w-full flex-wrap p-1 md:col-span-1">
                            <label for="description" class="w-full text-[1rem]">Descrição</label>
                            <input required type="text" id="description" name="description" max="100"
                                value="{{ old('description') ? old('description') : $category->description }}"
                                class="w-full rounded-[4px] !border-none bg-apae-gray/10 px-2 py-1 !outline-none">
                        </div>

                        <div class="col-span-2 flex w-full flex-wrap p-1 md:col-span-1">
                            <label for="category" class="w-full text-[1rem]">Categoria (Slug)</label>
                            <input required type="text" id="category" name="category" max="100"
                                value="{{ old('category') ? old('category') : $category->category }}"
                                class="w-full rounded-[4px] !border-none bg-apae-gray/10 px-2 py-1 !outline-none">
                        </div>

                        <div class="col-span-2 flex w-full flex-wrap justify-between gap-4 py-3">
                            <a href="{{ route('admin.news.categories.index') }}"
                                class=" rounded-sm bg-apae-green px-6 py-1 text-apae-white shadow-md dark:bg-apae-gray">
                                Cancelar
                            </a>
                            <button type="submit"
                                class="rounded-sm bg-apae-green px-6 py-1 text-apae-white shadow-md dark:bg-apae-gray">
                                Atualizar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection

    @section('js-content')
        <script>
            document.getElementById('description').addEventListener('input', (event) => {
                const {
                    value
                } = event.target;

                document.getElementById('category').value = value.toString().toLowerCase().replace(/\s+/g, '-')
                    .replace(/[^a-z-0-9]/g, '');
            })
        </script>
    @endsection
</x-admin.app-default>
