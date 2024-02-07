<x-admin.app-default app_title="" page_title="{{ $title }}">
    @section('head')
        @vite('resources/js/photo-gallery/photo-gallery.js')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

        <style>
            .swiper {
                width: 100%;
                height: 100%;
            }

            .swiper-slide {
                text-align: center;
                font-size: 18px;
                background: #fff;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .swiper-slide img {
                display: block;
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            .swiper {
                width: 100%;
                height: 300px;
                margin-left: auto;
                margin-right: auto;
            }

            .swiper-slide {
                background-size: cover;
                background-position: center;
            }

            .mySwiper2 {
                height: 80%;
                width: 100%;
            }

            .mySwiper {
                height: 20%;
                box-sizing: border-box;
                padding: 10px 0;
            }

            .mySwiper .swiper-slide {
                width: 25%;
                height: 100%;
                opacity: 0.4;
            }

            .mySwiper .swiper-slide-thumb-active {
                opacity: 1;
            }

            .swiper-slide img {
                display: block;
                width: 100%;
                height: 100%;
                object-fit: cover;
            }
        </style>
    @endsection

    @section('content')
        <div class="mx-8 mb-10 mt-4">
            <div class="mb-5 flex w-full flex-wrap items-center justify-between gap-6">
                <a href="{{ route('admin.photos-gallery.add-image', ['galleryId' => request('galleryId')]) }}"
                    class="bg-apae-green px-2 py-1 text-apae-white shadow-md dark:bg-apae-gray-dark">Adicionar Imagens</a>

                <div class="flex gap-4">
                    <a href="{{ route('admin.photos-gallery.edit-gallery', ['galleryId' => request('galleryId')]) }}"
                        class="bg-apae-green px-2 py-1 text-apae-white shadow-md dark:bg-apae-gray-dark">
                        <i class="fa-solid fa-edit mr-2 text-apae-info"></i>
                        Editar Album
                    </a>
                    <button onclick="deleteAlbum()"
                        class="bg-apae-green px-2 py-0.5 text-apae-white shadow-md dark:bg-apae-gray-dark">
                        <i class="fa-solid fa-trash mr-2 text-apae-danger"></i>
                        Apagar Album
                    </button>
                </div>
            </div>

            <div class="bg-apae-white py-4 shadow-lg dark:bg-apae-gray-dark">

                @if (count($images) <= 0)
                    {{-- fa-brands fa-envira --}}
                    <section class="flex w-full items-center justify-center pb-8 pt-4">
                        <div class="apae-container">
                            <x-website.empty-container description="Ainda não foi carregada nenhuma foto para esse album."
                                icon="fas fa-file" />
                        </div>
                    </section>
                @else
                    <section class="flex h-[100vh] w-full justify-center gap-4 p-8">
                        <div class="w-full">
                            <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff"
                                class="swiper mySwiper2 w-full">
                                <div class="swiper-wrapper w-full">

                                    @foreach ($images as $photo)
                                        <div class="swiper-slide w-full">
                                            <img src="{{ Vite::galleryImages('albuns/' . $photo->filename) }}" />
                                        </div>
                                    @endforeach

                                </div>

                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>

                            </div>

                            <div thumbsSlider="" class="swiper mySwiper">
                                <div class="swiper-wrapper">
                                    @foreach ($images as $photo)
                                        <div class="swiper-slide relative w-full">
                                            <img src="{{ Vite::galleryImages('albuns/' . $photo->filename) }}" />
                                            <div class="absolute bottom-0 right-0 z-10 w-full">
                                                <button imageId="{{ $photo->id }}"
                                                    class="deleteImage w-full bg-apae-green py-1 text-apae-white">
                                                    <i class="fa-solid fa-trash text-apae-danger"></i>
                                                    Apagar
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </section>
                @endif
            </div>

        @endsection

        @section('js-content')
            <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
            <script>
                var swiper = new Swiper(".mySwiper", {
                    loop: true,
                    spaceBetween: 10,
                    slidesPerView: 4,
                    freeMode: true,
                    watchSlidesProgress: true,
                });
                var swiper2 = new Swiper(".mySwiper2", {
                    loop: true,
                    spaceBetween: 10,
                    navigation: {
                        nextEl: ".swiper-button-next",
                        prevEl: ".swiper-button-prev",
                    },
                    thumbs: {
                        swiper: swiper,
                    },
                });


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
