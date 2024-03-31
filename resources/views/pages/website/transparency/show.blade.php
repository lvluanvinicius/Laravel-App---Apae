<x-website.web-layout pageTitle="{{ $title }}">
    @section('content')
        <x-website.page-title title="{{ $subtitle }}" />

        <section class="mt-4 flex min-h-[600px] justify-center pb-8">
            <div class="apae-container grid grid-cols-4 gap-4">

                @if (count($folders) <= 0)
                    <x-website.empty-container description="Ainda não existem pastas." icon="fas fa-folder" />
                @else
                    @foreach ($folders as $folder)
                        <a href="{{ route('transparency.show.documents', ['transparencyId' => request('transparencyId'), 'folderId' => $folder->id]) }}"
                            class="relative col-span-4 flex h-40 flex-col items-center justify-center md:col-span-1">
                            <i class="fas fa-folder text-[6rem] text-apae-yellow"></i>
                            <span class="text-[1rem] font-bold text-apae-gray-dark/75">
                                {{ $folder->folders }}
                            </span>
                        </a>
                    @endforeach
                @endif
            </div>
        </section>

        <section class="flex justify-center pb-8 pt-4">
            <div class="apae-container">
                {{ $folders->links('pagination::apae') }}
            </div>
        </section>
    @endsection
</x-website.web-layout>
