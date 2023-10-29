<x-admin.app-default app_title="" page_title="{{ $title }}">
    @section('content')
        <div class="mx-8 mt-4 mb-10">
            <div class="dark:bg-apae-gray-dark dark:text-apae-white text-apae-gray-dark bg-apae-white shadow-md p-6">
                <form action="{{ route('admin.photos-gallery.store-album') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="flex flex-wrap">
                        <label for="gallery_name" class="">Nome do Album: </label>
                        <input type="text" name="gallery_name" id="gallery_name"
                            class="bg-apae-gray/10 px-2 py-1 w-full !border-none !outline-none"
                            value="{{ old('gallery_name') }}">
                    </div>

                    <div class="flex flex-wrap py-6">
                        <label for="gallery_cover" class="border p-4 w-full border-dashed text-center text-apae-gray/80">Selecione a Capa</label>
                        <input type="file" id="gallery_cover" name="gallery_cover" class="hidden" value="{{ old('gallery_cover') }}">
                    </div>

                    <div class="flex flex-wrap ">
                        <img src="" alt="" id="preview-image" class="">
                    </div>

                    <div class="flex flex-wrap pt-6">
                        <label for="gallery_description" class="">Descrição: </label>
                        <textarea name="gallery_description" id="gallery_description"
                            class="bg-apae-gray/10 px-2 py-1 w-full !border-none !outline-none" rows="10" cols="10">
                        </textarea>
                    </div>

                    <div class="flex flex-wrap py-3">
                        <button
                            class="float-right px-6 shadow-md bg-apae-green dark:bg-apae-gray text-apae-white rounded-sm">
                            Salvar
                        </button>
                    </div>

                </form>
            </div>
        </div>
    @endsection

    @section('js-content')
        <script>
            // Carrega o valor no textarea da sessão se ocorrer erros na verificação dos campos.
            document.querySelector('#gallery_description').value = `{{ old('gallery_description') }}`;

            // Seleciona o input da imagem de capa.
            document.getElementById('gallery_cover').addEventListener('change', function(event) {
                const file = event.target.files[0]; // Busca o arquivo para upload.

                // Verifica se existe arquivo.
                if (file) {
                    const reader = new FileReader();

                    reader.onload = (e) => {
                        const previewImage = document.querySelector('#preview-image');
                        previewImage.classList.add('h-52');
                        previewImage.src = e.target.result;
                    };

                    reader.readAsDataURL(file); // Carrega o arquivo como URL de dados.
                }
            });
        </script>
    @endsection
</x-admin.app-default>
