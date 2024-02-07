<x-website.web-layout pageTitle="{{ $title }}">
    @section('content')
        <x-website.page-title title="{{ $subtitle }}" />

        <section class="mt-4 flex justify-center pb-8">
            <div class="apae-container grid grid-cols-4 gap-4">

                @if (count($files) <= 0)
                    <x-website.empty-container description="Ainda não existem arquivos." icon="fas fa-file" />
                @else
                    @foreach ($files as $file)
                        <div class="relative col-span-4 flex h-40 flex-col items-center justify-center gap-2 md:col-span-1">
                            @if ($file->ext === 'pdf')
                                <i class="fas fa-file-pdf text-[7rem] text-red-400"></i>
                            @elseif ($file->ext === 'png' || $file->ext === 'jpg' || $file->ext === 'webp' || $file->ext === 'jpeg')
                                <i class="fas fa-file-image text-[7rem] text-blue-400"></i>
                            @endif
                            <button
                                class="w-[50%] rounded-md border bg-apae-green px-2 py-0.5 text-apae-white shadow-md shadow-apae-dark/20">
                                Baixar
                            </button>
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
