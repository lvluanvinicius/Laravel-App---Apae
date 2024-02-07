<x-website.web-layout appTitle="" pageTitle="{{ $title }}">

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
        <x-website.page-title title="{{ $subtitle }}" />


        <section class="flex w-full justify-center gap-4 py-4 text-[.9rem]">
            <div class="apae-container rounded-md bg-apae-white p-4 shadow-md shadow-apae-gray/10">
                <div class="w-full">
                    <h3 class="font-bold">Data de Postagem: </h3>
                    <time class="">{{ date('d/m/Y \à\s H\hm\m', strtotime($gallery->created_at)) }}</time>
                </div>


                <div class="w-full">
                    <h3 class="mt-2 font-bold">Descrição: </h3>
                    <p class="font[500] indent-4 text-[.9rem]">{{ $gallery->gallery_description }}</p>
                </div>
            </div>
        </section>



        @if (count($photos) <= 0)
            {{-- fa-brands fa-envira --}}
            <section class="flex w-full items-center justify-center pb-8 pt-4">
                <div class="apae-container">
                    <x-website.empty-container description="Ainda não foi carregada nenhuma foto para esse album."
                        icon="fas fa-file" />
                </div>
            </section>
        @else
            <section class="flex h-[100vh] w-full justify-center gap-4 py-4">
                <div class="apae-container">
                    <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff"
                        class="swiper mySwiper2 w-full">
                        <div class="swiper-wrapper w-full">

                            @foreach ($photos as $photo)
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
                            @foreach ($photos as $photo)
                                <div class="swiper-slide w-full">
                                    <img src="{{ Vite::galleryImages('albuns/' . $photo->filename) }}" />
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        @endif


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
        </script>
    @endsection
</x-website.web-layout>
