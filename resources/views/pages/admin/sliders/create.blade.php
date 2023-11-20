<x-admin.app-default app_title="" page_title="{{ $title }}">

    @section('head')
        <script src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js"></script>
        <link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css" />
    @endsection

    @section('content')
        <div class="px-8 mt-10">
            <div class="bg-apae-white dark:bg-apae-gray-dark shadow-md p-8">

                <form action="/file-upload" class="dropzone" id="dropzone-sliders">
                </form>

                <div class="flex flex-wrap mt-4 gap-4">
                    <a href="{{ route('admin.sliders.index') }}"
                        class="float-right px-6 shadow-md bg-apae-green dark:bg-apae-gray text-apae-white rounded-sm">Voltar</a>
                </div>

            </div>
        </div>
    @endsection

    @section('js-content')
        <script>
            // Recuperando rota para salvar o arquivo.
            const fileRouteSave = "{{ route('admin.sliders.store') }}";

            const sliders = new Dropzone('#dropzone-sliders', {
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
                        sliders.removeFile(file); // Remove o arquivo da lista de upload
                    } else {
                        iziToast.error({
                            title: "Ooops!",
                            message: response.message,
                            position: 'topRight'
                        });
                        sliders.removeFile(file); // Remove o arquivo da lista de upload
                    }
                },
            });
        </script>
    @endsection

</x-admin.app-default>
