<x-admin.app-default app_title="" page_title="{{ $title }}">

    @section('content')
        <div class="mx-2 mt-4 md:mx-8">

            <div class="mb-4 w-[400px] rounded-sm bg-apae-white p-4 shadow-md shadow-apae-gray/30 md:w-[600px]">
                <form action="{{ route('admin.statute.store') }}" class="flex w-full flex-col gap-4" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="flex flex-wrap items-center">
                        <h2 class="text-[1.3rem] font-bold">Atualizar Estatuto</h2>
                    </div>
                    <div class="flex flex-wrap items-center">
                        <label for="name" class="w-full pb-1">
                            Arquivo PDF
                        </label>
                        <input type="file" id="file" name="file" />
                    </div>

                    {{-- <div class="flex flex-wrap items-center">
                    <label for="status" class="w-full pb-1 font-semibold">
                        Nome
                    </label>
                    <input type="checkbox" name="status" id="status" class="!border !border-apae-dark" />
                </div> --}}

                    <div class="flex flex-wrap items-center">
                        <button class="w-full rounded bg-apae-green py-2 font-semibold text-apae-white">Atualizar</button>
                    </div>
                </form>

            </div>

            @if ($statute)
                <div class="mb-4 w-full rounded-sm bg-apae-white p-4 shadow-md shadow-apae-gray/30">
                    <div class="statute-page w-full">
                        <iframe class="h-[100vh] w-full"
                            src="{{ asset('storage/statute/' . $statute->file_name) }}"></iframe>
                    </div>
                </div>
            @endif
        </div>
    @endsection

</x-admin.app-default>
