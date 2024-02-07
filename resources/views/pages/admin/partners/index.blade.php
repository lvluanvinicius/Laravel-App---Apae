<x-admin.app-default app_title="" page_title="{{ $title }}">
    @section('content')
        <div class="mx-2 mt-4 md:mx-8">
            <div class="grid w-full grid-cols-12">

                <div class="col-span-12">
                    <div class="px-5">
                        <a href="{{ route('admin.partners.create') }}"
                            class="rounded-sm bg-apae-green px-6 py-1 text-apae-white shadow-md dark:bg-apae-gray-dark">
                            Novo Parceiro
                        </a>
                    </div>
                </div>

                @foreach ($partners as $partner)
                    <div class="col-span-12 p-6 md:col-span-3">
                        <a href="{{ route('admin.partners.show', ['partnerID' => $partner->id]) }}">
                            <div class="relative h-56 bg-apae-gray-dark">
                                <img src="{{ asset('images/partners/' . $partner->partner_image) }}" alt=""
                                    class="h-full w-full opacity-90">
                                <div
                                    class="absolute bottom-0 left-0 w-full bg-apae-gray-dark/50 py-4 text-center text-apae-white">
                                    {{ $partner->partner_name }}
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach

            </div>

            {{ $partners->links('pagination::tailwind') }}
        </div>
    @endsection
</x-admin.app-default>
