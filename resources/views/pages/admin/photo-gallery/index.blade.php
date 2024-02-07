<x-admin.app-default app_title="" page_title="{{ $title }}">
    @section('content')
        <div class="mx-8 mt-4">
            <div class="grid w-full grid-cols-12">

                <div class="col-span-12">
                    <div class="px-5">
                        <a href="{{ route('admin.photos-gallery.create-album') }}"
                            class="rounded-sm bg-apae-green px-6 py-1 text-apae-white shadow-md dark:bg-apae-gray-dark">
                            Novo Album
                        </a>
                    </div>
                </div>

                @foreach ($albuns as $alb)
                    <div class="col-span-12 p-6 md:col-span-3">
                        <a href="{{ route('admin.photos-gallery.view-gallery', ['galleryId' => $alb->id]) }}"
                            class="w-full text-[.9rem] underline">
                            <div class="relative h-80 rounded border shadow-md shadow-apae-dark">
                                <img src="{{ asset('images/photo-galery/' . $alb->gallery_image) }}" alt=""
                                    class="h-full w-full">

                                <div
                                    class="absolute bottom-0 left-0 flex w-full flex-wrap items-center justify-end bg-apae-gray-dark/50 px-2 py-2 text-[.8rem] text-apae-white">
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
