<x-admin.app-default app_title="" page_title="{{ $title }}">
    @section('content')
        <div class="mx-8 mt-4">
            
            <div class="grid grid-cols-12 w-full">

                <div class="col-span-12">
                    <div class="px-5">
                        <a href="{{ route('admin.sliders.create') }}"
                            class="px-6 py-1 shadow-md bg-apae-green dark:bg-apae-gray-dark text-apae-white rounded-sm">
                            Novo Slider
                        </a>
                    </div>
                </div>
            

            @foreach ($sliders as $slider)
            <div class="col-span-3 md:col-span-3 p-6 ">
                <a href="{{ route('admin.photos-gallery.view-gallery', ['galleryId' => $slider->id]) }}" class="w-full underline text-[.9rem]">
                    <div class="border relative shadow-md shadow-apae-dark rounded h-[15rem]">
                        <img src="{{ Vite::galleryImages($slider->sliders_image) }}" alt="" class="h-full w-full">

                        <div
                            class="absolute bottom-0 left-0 w-full bg-apae-gray-dark/50 py-2 px-2 flex flex-wrap items-center justify-end text-[.8rem] text-apae-white">
                            <div class="w-full">
                                {{ 'teste' }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
            
        </div>
    @endsection

    @section('js-content')
    <script>
        //
    </script>
@endsection
</x-admin.app-default>
