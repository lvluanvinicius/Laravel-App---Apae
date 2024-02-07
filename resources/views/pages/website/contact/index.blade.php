<x-website.web-layout appTitle="" pageTitle="{{ $title }}">
    @section('head')
    @vite('resources/js/contact/contact.js')
    @endsection

    @section('content')

    <x-website.page-title title="{{$subtitle}}"/>

    <section class="flex justify-center" id="contacts"></section>

    @endsection
</x-website.web-layout>


