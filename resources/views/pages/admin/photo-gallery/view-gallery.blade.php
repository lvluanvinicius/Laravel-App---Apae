<x-admin.app-default app_title="" page_title="{{ $title }}">
    @section('content')
        <div class="mx-8 mt-4 mb-10">
            <div class="w-full mb-5 flex gap-6 flex-wrap justify-between items-center">
                <a href="{{ route('admin.photos-gallery.add-image', ['galleryId' => request('galleryId')]) }}"
                    class="text-apae-white bg-apae-green dark:bg-apae-gray-dark px-2 py-1 shadow-md">Adicionar Imagens</a>

                <div class="flex gap-4">
                    <a href="{{ route('admin.photos-gallery.edit-gallery', ['galleryId' => request('galleryId')]) }}"
                        class="text-apae-white bg-apae-green dark:bg-apae-gray-dark px-2 py-1 shadow-md">
                        <i class="fa-solid fa-edit text-apae-info mr-2"></i>
                        Editar Album
                    </a>
                    <button onclick="deleteAlbum()"
                        class="text-apae-white bg-apae-green dark:bg-apae-gray-dark px-2 py-0.5 shadow-md">
                        <i class="fa-solid fa-trash text-apae-danger mr-2"></i>
                        Apagar Album
                    </button>
                </div>
            </div>

            <div class="bg-apae-white dark:bg-apae-gray-dark shadow-lg p-4">
                <div class="w-full">
                    <div class="">
                        <h1 class="font-bold text-[1.1rem]">{{ $gallery->gallery_name }}</h1>
                        <span class="font-bold text-[.8rem]">Atualizado em:</span>
                        <span class="text-[.7rem]">{{ date('d/m/Y \a\s H:i:s', strtotime($gallery->updated_at)) }}</span>
                    </div>
                    <div class="w-full mt-1">
                        <h3 class="font-bold text-[.9rem]">Descrição:</h3>
                        <p class="text-[.8rem]" style="margin: 0;text-indent: 3ch;">
                            {{ $gallery->gallery_description }}
                        </p>
                    </div>
                </div>
                <div id="custom-controls-gallery" class="relative w-full" data-carousel="slide">
                    <!-- Carousel wrapper -->
                    <div class="relative h-56 overflow-hidden rounded-lg md:h-96 w-full">

                        @foreach ($images as $img)
                            @if (count($images) == 1)
                                <div class="">
                                    <img src="{{ Vite::galleryAlbunsImages($img->filename) }}"
                                        class="absolute block max-w-full h-[100%] -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                                        alt="">
                                    <div class="absolute right-0 bottom-0">
                                        <button imageId="{{ $img->id }}" class="deleteImage">
                                            <i class="fa-solid fa-trash text-apae-danger"></i>
                                            Apagar Imagem
                                        </button>
                                    </div>
                                </div>
                            @else
                                <div class="hidden duration-1000 ease-in-out" data-carousel-item>
                                    <img src="{{ Vite::galleryAlbunsImages($img->filename) }}"
                                        class="absolute block max-w-full h-[100%] -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                                        alt="">
                                    <div class="absolute right-0 bottom-0">
                                        <button imageId="{{ $img->id }}" class="deleteImage">
                                            <i class="fa-solid fa-trash text-apae-danger"></i>
                                            Apagar Imagem
                                        </button>
                                    </div>
                                </div>
                            @endif
                        @endforeach

                    </div>
                    <div class="flex justify-center items-center pt-4">
                        <button type="button"
                            class="flex justify-center items-center mr-4 h-full cursor-pointer group focus:outline-none"
                            data-carousel-prev>
                            <span
                                class="text-gray-400 hover:text-gray-900 dark:hover:text-white group-focus:text-gray-900 dark:group-focus:text-white">
                                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" />
                                </svg>
                                <span class="sr-only">Previous</span>
                            </span>
                        </button>
                        <button type="button"
                            class="flex justify-center items-center h-full cursor-pointer group focus:outline-none"
                            data-carousel-next>
                            <span
                                class="text-gray-400 hover:text-gray-900 dark:hover:text-white group-focus:text-gray-900 dark:group-focus:text-white">
                                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                </svg>
                                <span class="sr-only">Next</span>
                            </span>
                        </button>
                    </div>
                </div>

                <div class="flex flex-wrap mt-4 gap-4">
                    <a href="{{ route('admin.photos-gallery.index') }}"
                        class="float-right px-6 shadow-md bg-apae-green dark:bg-apae-gray text-apae-white rounded-sm">Voltar</a>
                </div>
            </div>

        </div>
    @endsection

    @section('js-content')
        <script>
            const deleteImageButtons = document.querySelectorAll('.deleteImage');
            for (let btn of deleteImageButtons) {
                btn.addEventListener('click', function() {
                    if (confirm('Deseja realmente excluír essa imagem?')) {
                        deleteImage(btn.attributes.imageid.value);
                    }
                });
            }

            // Função efetua a exclusão da imagem.
            function deleteImage(imageId) {
                // Recuperando rota de exclusão.
                const deleteRoute = `{{ route('admin.photos-gallery.delete-file-image', ['imageId' => '__IMAGEID__']) }}`
                    .replace('__IMAGEID__', imageId);

                // Criando formulário de exclusão.
                const FormDeleteImage = document.createElement('form');
                FormDeleteImage.action = deleteRoute;
                FormDeleteImage.method = 'POST';

                // Criando input de metodo. 
                const InputMethod = document.createElement('input');
                InputMethod.value = 'DELETE';
                InputMethod.name = '_method';

                // Criando input para csrf-token.
                const InputCSRFToken = document.createElement('input');
                InputCSRFToken.value = `{{ csrf_token() }}`;
                InputCSRFToken.name = '_token';

                FormDeleteImage.appendChild(InputMethod);
                FormDeleteImage.appendChild(InputCSRFToken);

                // Adicionando formulario no documento da pagina.
                document.body.appendChild(FormDeleteImage);
                FormDeleteImage.submit();

            }

            // Função efetua a exclusão do album.
            function deleteAlbum() {
                if (confirm('Deseja realmente excluír esse album?')) {
                    // Recuperando rota de exclusão.
                    const deleteRoute =
                        `{{ route('admin.photos-gallery.delete-gallery-image', ['galleryId' => request('galleryId')]) }}`;

                    // Criando formulário de exclusão.
                    const FormDeleteAlbum = document.createElement('form');
                    FormDeleteAlbum.action = deleteRoute;
                    FormDeleteAlbum.method = 'POST';

                    // Criando input de metodo. 
                    const InputMethod = document.createElement('input');
                    InputMethod.value = 'DELETE';
                    InputMethod.name = '_method';
                    InputMethod.type = 'hidden';

                    // Criando input para csrf-token.
                    const InputCSRFToken = document.createElement('input');
                    InputCSRFToken.value = `{{ csrf_token() }}`;
                    InputCSRFToken.name = '_token';
                    InputCSRFToken.type = 'hidden';

                    FormDeleteAlbum.appendChild(InputMethod);
                    FormDeleteAlbum.appendChild(InputCSRFToken);

                    // Adicionando formulario no documento da pagina.
                    document.body.appendChild(FormDeleteAlbum);
                    FormDeleteAlbum.submit();

                }
            }
        </script>
    @endsection
</x-admin.app-default>
