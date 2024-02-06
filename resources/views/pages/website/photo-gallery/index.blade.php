<x-website.web-layout appTitle="" pageTitle="{{ $title }}">
    @section('content')
        <x-website.page-title title="{{ $subtitle }}" />

        <section class="flex h-[100vh] w-full flex-wrap justify-center py-5">

            <div class="apae-container grid w-full grid-cols-4 gap-4">

                @if (count($galleries) <= 0)
                    <x-website.empty-container description="Ainda não existe nenhuma galeria de fotos."
                        icon="fa-brands fa-envira" />
                @else
                    @foreach ($galleries as $gallery)
                        <a href="{{ route('photo-gallery.view', ['galleryId' => $gallery->id]) }}"
                            class="relative col-span-4 max-h-[18.75rem] rounded-md border border-apae-dark/30 shadow-lg shadow-apae-dark/20 md:col-span-2 lg:col-span-1">
                            <div class="h-full border">
                                <img src="{{ Vite::galleryImages($gallery->gallery_image) }}" alt=""
                                    class="h-full w-full">
                            </div>

                            <div class="absolute left-0 top-0 flex h-full w-full flex-col justify-end rounded-md">
                                <div class="rounded-b-md bg-apae-white px-2 py-4">
                                    <h3 class="text-center text-[1.1rem]">{{ $gallery->gallery_name }}</h3>
                                </div>
                            </div>
                        </a>
                    @endforeach
                @endif

            </div>

            <div class="apae-container flex w-full justify-center py-5">
                {{ $galleries->links('pagination::apae') }}
            </div>
        </section>
    @endsection
</x-website.web-layout>
