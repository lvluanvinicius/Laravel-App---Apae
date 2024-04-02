<x-admin.app-default app_title="" page_title="{{ $title }}">

    @section('content')
        <div id="news-edit" data-news-id="{{ request('newsId') }}"></div>
    @endsection
</x-admin.app-default>
