<x-website.web-layout appTitle="" pageTitle="{{ $title }}">
    @section('content')
        <x-website.sliders/>

    @endsection

    @section('head')
        @yield('swiper-css')
        @yield('footer-css')
    @endsection

    @section('js-content')
        @yield('swiper-js')
    @endsection

</x-website.web-layout>
