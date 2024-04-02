<x-admin.app-default app_title="" page_title="{{ $title }}">
    @section('head')
        <link rel="stylesheet" href="https://unpkg.com/react-quill@1.3.3/dist/quill.snow.css">
    @endsection
    @section('content')
        <div id="create-news-editor"></div>
    @endsection
</x-admin.app-default>
