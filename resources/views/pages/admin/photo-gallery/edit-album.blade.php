<x-admin.app-default app_title="" page_title="{{ $title }}">
    @section('content')
        <div class="mx-8 mb-10 mt-4">
            <div class="bg-apae-white p-6 text-apae-gray-dark shadow-md dark:bg-apae-gray-dark dark:text-apae-white">
                <form action="{{ route('admin.photos-gallery.update-album', ['galleryId' => $gallery->id]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="flex flex-wrap">
                        <label for="gallery_name" class="">Nome do Album: </label>
                        <input type="text" name="gallery_name" id="gallery_name"
                            class="w-full !border-none bg-apae-gray/10 px-2 py-1 !outline-none"
                            value="{{ old('gallery_name') ? old('gallery_name') : $gallery->gallery_name }}">
                    </div>

                    <div class="flex flex-wrap py-6">
                        <label for="gallery_cover"
                            class="w-full cursor-pointer border border-dashed p-4 text-center text-apae-gray/80">Selecione a
                            Capa</label>
                        <input type="file" id="gallery_cover" name="gallery_cover" class="hidden"
                            value="{{ old('gallery_cover') }}">
                    </div>

                    <div class="flex flex-wrap">
                        <img src="{{ asset('images/photo-galery/' . $gallery->gallery_image) }}" alt=""
                            id="preview-image" class="h-52">
                    </div>

                    <div class="flex flex-wrap pt-6">
                        <label for="gallery_description" class="">Descrição: </label>
                        <textarea name="gallery_description" id="gallery_description"
                            class="w-full !border-none bg-apae-gray/10 px-2 py-1 !outline-none" rows="10" cols="10">
                        </textarea>
                    </div>

                    <div class="flex flex-wrap gap-4 py-3">
                        <button
                            class="float-right rounded-sm bg-apae-green px-6 text-apae-white shadow-md dark:bg-apae-gray">
                            Salvar
                        </button>
                        <a href="{{ route('admin.photos-gallery.view-gallery', ['galleryId' => $gallery->id]) }}"
                            class="float-right rounded-sm bg-apae-green px-6 text-apae-white shadow-md dark:bg-apae-gray">
                            Cancelar
                        </a>
                    </div>

                </form>
            </div>
        </div>
    @endsection

    @section('js-content')
        <script>
            // Carrega o valor no textarea da sessão se ocorrer erros na verificação dos campos.
            document.querySelector('#gallery_description').value =
                `{{ old('gallery_description') ? old('gallery_description') : $gallery->gallery_description }}`;

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
