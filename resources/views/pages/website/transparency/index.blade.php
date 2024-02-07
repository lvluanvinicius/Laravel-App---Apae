<x-website.web-layout pageTitle="{{ $title }}">
    @section('content')
        <x-website.page-title title="{{ $subtitle }}" />

        <section class="mt-4 flex justify-center pb-8">
            <div class="apae-container grid grid-cols-4 gap-4">
                @if (count($years) <= 0)
                    <x-website.empty-container description="Ainda não existe nenhum Ano cadastrado." icon="fas fa-calendar" />
                @else
                    @foreach ($years as $year)
                        <a href="{{ route('transparency.show', ['transparencyId' => $year->id]) }}"
                            class="col-span-4 flex h-40 items-center justify-center rounded-bl-[2rem] rounded-tr-[2rem] border-b-[2px] border-apae-orange bg-apae-white shadow-md shadow-apae-gray-dark/20 md:col-span-1">
                            <h1>{{ $year->year_folder }}</h1>
                        </a>
                    @endforeach
                @endif


            </div>
        </section>

        <section class="flex justify-center pb-8 pt-4">
            <div class="apae-container">
                {{ $years->links('pagination::apae') }}
            </div>
        </section>
    @endsection
</x-website.web-layout>
