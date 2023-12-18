<x-admin.app-default app_title="" page_title="{{ $title }}">
    @section('content')
    <div class="mx-8 mt-4">
        <div class="grid grid-cols-12 w-full">
            
            <div class="col-span-12">
                <div class="px-5">
                    <a href="{{ route('admin.news.create') }}"
                        class="px-6 py-1 shadow-md bg-apae-green dark:bg-apae-gray-dark text-apae-white rounded-sm">
                        Nova Notícia
                    </a>
                </div>
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
