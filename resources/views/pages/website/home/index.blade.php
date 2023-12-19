<x-website.web-layout appTitle="" pageTitle="{{ $title }}">
    @section('head')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    @endsection

    @section('content')
        @if (count($sliders) !== 0)
            <section class="swiper mySwiper h-[calc(100vh-4vh-7rem)]">
                <div class="swiper-wrapper">
                    @foreach ($sliders as $slider)
                        <div class="swiper-slide">
                            <img src="{{ Vite::slidersImages($slider->sliders_image) }}"
                                alt="{{ explode('-', $slider->sliders_hash)[0] }}" class="h-full w-full">
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </section>
        @endif

        <section class="bg-apae-green shadow-md w-full flex justify-center items-center z-10">
            <div class="apae-container h-full flex justify-start">
                
                <div>teste</div>
                <div>teste</div>
                <div>teste</div>

            </div>
        </section>
    @endsection

    @section('js-content')
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
        <script>
            var swiper = new Swiper(".mySwiper", {
                slidesPerView: 1,
                spaceBetween: 30,
                grabCursor: true,
                effect: "creative",
                creativeEffect: {
                    prev: {
                        shadow: true,
                        origin: "left center",
                        translate: ["-5%", 0, -200],
                        rotate: [0, 100, 0],
                    },
                    next: {
                        origin: "right center",
                        translate: ["5%", 0, -200],
                        rotate: [0, -100, 0],
                    },
                },
                loop: true,
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false
                }
            });
        </script>
    @endsection

</x-website.web-layout>
