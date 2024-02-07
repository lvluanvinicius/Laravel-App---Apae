<x-website.web-layout appTitle="" pageTitle="{{ $title }}">
    @section('content')

    <x-website.sliders/>
    <x-website.partners/>

    @endsection

    @section('head')
        @yield('swiper-css')
        @yield('footer-css')
    @endsection

    @section('js-content')
        @yield('swiper-js')
    @endsection

</x-website.web-layout>
