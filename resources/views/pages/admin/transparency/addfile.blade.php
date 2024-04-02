<x-admin.app-default app_title="" page_title="{{ $title }}">

    @section('head')
        <script src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js"></script>
        <link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css" />
    @endsection

    @section('content')
        <div class="mx-2 mt-4 md:mx-8">
            <div class="bg-apae-white p-8 shadow-md dark:bg-apae-gray-dark">
                <div class="mb-4 flex flex-col">
                    <h1>
                        <span class="font-bold uppercase">Ano:{{ '' }}</span>
                        <span>{{ $folder->year_folder }}</span>
                    </h1>
                    <h1>
                        <span class="font-bold uppercase">Sessão:{{ '' }}</span>
                        <span>{{ $folder->folders }}</span>
                    </h1>
                </div>

                <form action="/file-upload" class="dropzone" id="dropzone-transparency">
                </form>

                <div class="mt-4 flex flex-wrap gap-4">
                    <a href="{{ route('admin.transparency.index') }}"
                        class="float-right rounded-sm bg-apae-green px-6 text-apae-white shadow-md dark:bg-apae-gray">Voltar</a>
                </div>

            </div>
        </div>
    @endsection

    @section('js-content')
        <script>
            // Recuperando rota para salvar o arquivo.
            const fileRouteSave =
                `{{ route('admin.transparency.create-file-session-store', ['folderSession' => request('folderSession')]) }}`;

            const transparency = new Dropzone('#dropzone-transparency', {
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
                        transparency.removeFile(file); // Remove o arquivo da lista de upload
                    } else {
                        iziToast.error({
                            title: "Ooops!",
                            message: response.message,
                            position: 'topRight'
                        });
                        transparency.removeFile(file); // Remove o arquivo da lista de upload
                    }
                },
                error: function(file, {
                    xhr
                }) {
                    if (file.xhr.status === 422) {
                        const errorResponse = JSON.parse(file.xhr.response);

                        if (errorResponse.errors) {
                            for (let err in errorResponse.errors) {
                                iziToast.error({
                                    title: "Ooops!",
                                    message: errorResponse.errors[err][0],
                                    position: 'topRight'
                                });
                            }
                        }

                        transparency.removeFile(file)

                        return null;
                    }

                    console.error(xhr);
                    transparency.removeFile(file)
                }
            });
        </script>
    @endsection

</x-admin.app-default>
