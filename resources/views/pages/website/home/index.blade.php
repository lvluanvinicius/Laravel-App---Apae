<x-website.web-layout appTitle="" pageTitle="{{ $title }}">
    @section('head')
        <link rel="stylesheet" href="{{Vite::libs('OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css')}}">
        <link rel="stylesheet" href="{{Vite::libs('OwlCarousel2-2.3.4/dist/assets/owl.theme.default.min.css')}}">
    @endsection
    
    @section('content')

        <section class="owl-carousel owl-theme owl-loaded h-[40.43rem]">
            <div class="owl-stage-outer h-full">
                <div class="owl-stage h-full">
                    @foreach ($sliders as $slider)
                    <img src="{{ Vite::slidersImages($slider->sliders_image) }}" alt="{{ explode('-', $slider->sliders_hash)[0] }}" class="owl-item h-full">
                    @endforeach 
                </div>
            </div>
        </section>


    @endsection

    @section('js-content')
        <script src="{{Vite::libs('OwlCarousel2-2.3.4/dist/owl.carousel.min.js')}}"></script>
        <script>
            const sliderView = $('.owl-carousel');

            sliderView.owlCarousel({
                loop: true,
                nav: false,
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:1
                    },            
                    960:{
                        items:1
                    },
                    1200:{
                        items:1
                    }
                },
                autoplay: true,
                autoplayTimeout: 3000,
                autoplayHoverPause: true,
                autoplaySpeed: 500,
                
            });

            sliderView.on('mousewheel', '.owl-stage', function (e) {
                if (e.deltaY>0) {
                    owl.trigger('next.owl');
                } else {
                    owl.trigger('prev.owl');
                }
                e.preventDefault();
            });

        </script>
    @endsection
    
</x-website.web-layout>