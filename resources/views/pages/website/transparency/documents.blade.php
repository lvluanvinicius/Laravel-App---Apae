<x-website.web-layout pageTitle="{{ $title }}">
    @section('content')
        <x-website.page-title title="{{ $subtitle }}" />

        <section class="mt-4 flex min-h-[600px] justify-center pb-8">
            <div class="apae-container grid grid-cols-4 gap-4">

                @if (count($files) <= 0)
                    <x-website.empty-container description="Ainda não existem arquivos." icon="fas fa-file" />
                @else
                    @foreach ($files as $file)
                        <div class="relative col-span-4 flex !h-64 flex-col items-center justify-center gap-2 md:col-span-1">
                            @if ($file->ext === 'pdf')
                            <iframe src="{{ asset('/storage/transparency/' . $file->filename) }}"
                                class="w-full h-full shadow"
                                frameborder="0"></iframe>
                            @elseif ($file->ext === 'png' || $file->ext === 'jpg' || $file->ext === 'webp' || $file->ext === 'jpeg')
                            <img src="{{ asset('/storage/transparency/' . $file->filename) }}"
                                class="w-full h-full shadow-md"/>
                            @endif

                            <h3 class="w-full text-center">{{$file->filename}}</h3>
                            <a target="_blank" href="{{ asset('/storage/transparency/' . $file->filename) }}"
                                class="w-[50%] rounded-md border bg-apae-green px-2 py-0.5 text-center text-apae-white shadow-md shadow-apae-dark/20">
                                Vizualizar
                            </a>
                        </div>
                    @endforeach
                @endif

            </div>
        </section>

        <section class="flex justify-center pb-8 pt-4">
            <div class="apae-container">
                {{ $files->links('pagination::apae') }}
            </div>
        </section>
    @endsection
</x-website.web-layout>
