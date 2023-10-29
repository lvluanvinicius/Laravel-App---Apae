<x-admin.app-default app_title="" page_title="{{ $title }}">
    @section('content')
        <div class="mx-8 mt-4">
            <div class="grid grid-cols-12 w-full">

                <div class="col-span-12">
                    <div class="px-5">
                        <a href="{{ route('admin.photos-gallery.create-album') }}"
                            class="px-6 py-1 shadow-md bg-apae-green dark:bg-apae-gray-dark text-apae-white rounded-sm">
                            Novo Album
                        </a>
                    </div>
                </div>

                @foreach ($albuns as $alb)
                    <div class="col-span-12 md:col-span-3 p-6 ">
                        <a href="{{ route('admin.photos-gallery.view-gallery', ['galleryId' => $alb->id]) }}" class="w-full underline text-[.9rem]">
                            <div class="border relative shadow-md shadow-apae-dark rounded h-80">
                                <img src="{{ Vite::galleryImages($alb->gallery_image) }}" alt="" class="h-full w-full">

                                <div
                                    class="absolute bottom-0 left-0 w-full bg-apae-gray-dark/50 py-2 px-2 flex flex-wrap items-center justify-end text-[.8rem] text-apae-white">
                                    <div class="w-full">
                                        {{ $alb->gallery_name }}
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach

            </div>

            {{ $albuns->links('pagination::tailwind') }}
        </div>
    @endsection
</x-admin.app-default>
