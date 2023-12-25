<x-website.web-layout appTitle="" pageTitle="{{ $title }}">
    @section('content')
        <x-website.page-title title="{{ $title }}" />

        <div class="flex w-full flex-wrap justify-center py-5">

            <div class="apae-container grid w-full grid-cols-4 gap-4">

                @foreach ($galleries as $gallery)
                    <a href="#"
                        class="relative col-span-4 max-h-[18.75rem] rounded-md border border-apae-dark/30 shadow-lg shadow-apae-dark/20 md:col-span-2 lg:col-span-1">
                        <div class="border h-full">
                            <img src="{{ Vite::galleryImages($gallery->gallery_image) }}" alt="" class="h-full w-full">
                        </div>

                        <div class="absolute top-0 left-0 w-full h-full flex flex-col justify-end rounded-md">
                            <div class="bg-apae-white px-2 py-4 rounded-b-md">
                                <h3 class="text-[1.1rem] text-center">{{ $gallery->gallery_name }}</h3>
                            </div>
                        </div>
                    </a>
                @endforeach
                
            </div>

            <div class="apae-container flex w-full justify-center py-5">
                {{$galleries->links('pagination::apae')}}
            </div>
        </div>
    @endsection
</x-website.web-layout>
