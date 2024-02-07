<x-admin.app-default app_title="" page_title="{{ $title }}">
    @section('head')
        <script src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js"></script>
        {{-- <link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css" /> --}}
    @endsection

    @section('content')
        <div class="mx-8 mb-10 mt-4">
            <div class="rounded bg-apae-white px-6 py-4 shadow-xl dark:bg-apae-gray-dark dark:text-apae-white">
                <form action="/file-upload"
                    class="dropzone cursor-pointer border border-dashed border-apae-white/30 bg-apae-gray/10 p-6 text-center"
                    id="dropzone-gallery">
                </form>
                <div class="mt-4 flex flex-wrap gap-4">
                    <a href="{{ route('admin.photos-gallery.view-gallery', ['galleryId' => request('galleryId')]) }}"
                        class="float-right rounded-sm bg-apae-green px-6 text-apae-white shadow-md dark:bg-apae-gray">Voltar</a>
                </div>
            </div>

        </div>
    @endsection

    @section('js-content')
        <script>
            // Recuperando rota para salvar o arquivo.
            const fileRouteSave =
                `{{ route('admin.photos-gallery.create-new-file-image', ['galleryId' => request('galleryId')]) }}`;

            const gallery = new Dropzone('#dropzone-gallery', {
                url: fileRouteSave,
                method: 'post',
                maxFilesize: 100000,
                paramName: 'file',
                headers: {
                    'X-CSRF-TOKEN': `{{ csrf_token() }}`,
                },
                success: function(file, response) {
                    if (response.status) {
                        iziToast.success({
                            title: "Ooops!",
                            message: response.message,
                            position: 'topRight'
                        });
                        gallery.removeFile(file); // Remove o arquivo da lista de upload
                    } else {
                        iziToast.error({
                            title: "Ooops!",
                            message: response.message,
                            position: 'topRight'
                        });
                        gallery.removeFile(file); // Remove o arquivo da lista de upload
                    }
                },
            });
        </script>
    @endsection
</x-admin.app-default>
