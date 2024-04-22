<x-admin.app-default app_title="" page_title="{{ $title }}">

    @section('content')
        <div class="mx-8 mt-4">
            <div class="grid w-full grid-cols-12">

                <div class="col-span-12">
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('admin.news.index') }}"
                            class="rounded-sm bg-apae-green px-6 py-1 text-apae-white shadow-md dark:bg-apae-gray-dark">
                            Voltar
                        </a>
                        <a href="{{ route('admin.news.categories.create') }}"
                            class="rounded-sm bg-apae-green px-6 py-1 text-apae-white shadow-md dark:bg-apae-gray-dark">
                            Nova Categoria
                        </a>
                    </div>
                </div>


                <div
                    class="table-apae-content col-span-12 rounded bg-apae-white px-8 pb-8 pt-4 shadow-md dark:bg-apae-gray-dark">
                    <table class="table-apae" id="table-users">
                        <thead>
                            <tr class="text-left">
                                <th>Descrição</th>
                                <th>Categoria</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($categories as $category)
                                <tr class="text-left">
                                    <td>{{ $category->description }}</td>
                                    <td>{{ $category->category }}</td>
                                    <td>

                                        <div class="flex items-center justify-end gap-4">
                                            <a href="{{ route('admin.news.categories.edit', ['categoryId' => $category->id]) }}"
                                                class="text-apae-cyan"
                                                title="Editar Categoria: {{ $category->description }}">
                                                <i class="fa-solid fa-user-pen"></i>
                                            </a>

                                            <div class="button-delete-post-category"
                                                title="Apagar Categoria: {{ $category->description }}">
                                                <div data-category-id="{{ $category->id }}"></div>
                                            </div>


                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    @endsection

    @section('js-content')
        <script>
            //
        </script>
    @endsection
</x-admin.app-default>
