<x-admin.app-default app_title="" page_title="{{ $title }}">
    @section('content')
        <div class="mx-2 mt-4 md:mx-8">
            <div class="grid w-full grid-cols-12">

                <div class="col-span-12">
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('admin.news.create') }}"
                            class="rounded-sm bg-apae-green px-6 py-1 text-apae-white shadow-md dark:bg-apae-gray-dark">
                            Nova Notícia
                        </a>
                        <a href="{{ route('admin.news.categories.index') }}"
                            class="rounded-sm bg-apae-green px-6 py-1 text-apae-white shadow-md dark:bg-apae-gray-dark">
                            Categorias
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
                                <th>Vizualizações</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($news as $nw)
                                <tr class="text-left">
                                    <td>{{ $nw->news_post_title }}</td>
                                    <td>{{ $nw->news_post_slug }}</td>
                                    <td>{{ $nw->news_post_views }}</td>
                                    <td>
                                        @if ($nw->news_post_status)
                                            <div class="text-apae-teal">Ativo</div>
                                        @else
                                            <div class="text-apae-danger">Inativo</div>
                                        @endif
                                    </td>
                                    <td>

                                        <div class="flex items-center justify-end gap-4">
                                            <a href="{{ route('admin.news.edit', ['newsId' => $nw->id]) }}"
                                                class="text-apae-white" title="Editar Notícia: {{ $nw->news_post_title }}">
                                                <span class="rounded-md bg-apae-cyan px-4 py-1">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                    Editar
                                                </span>
                                            </a>

                                            <div class="button-delete-post-news"
                                                title="Apagar Notícia: {{ $nw->news_post_title }}">
                                                <div data-news-id="{{ $nw->id }}"></div>
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
