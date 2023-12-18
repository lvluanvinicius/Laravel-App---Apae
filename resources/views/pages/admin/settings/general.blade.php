<x-admin.app-default app_title="" page_title="{{ $title }}">
    @section('content')
        <div class="mx-8 mt-4">
            <div class="mb-4 grid w-full grid-cols-2 gap-4">

                <div class="col-span-2 md:col-span-1">
                    <div class="bg-apae-white p-6 text-apae-gray-dark shadow-md dark:bg-apae-gray-dark dark:text-apae-white">
                        <h1 class="mb-2 text-[1.4rem] font-bold">Extensões</h1>
                        <form action="{{ route('admin.settings.general.update-extensions') }}" method="post"
                            class="flex flex-wrap gap-4">
                            @csrf
                            @method('PUT')
                            @foreach ($settings as $stg)
                                @if ($stg['setting_type'] === 'extensions')
                                    <div class="flex w-full flex-wrap p-1">
                                        <label for="{{ $stg['setting_name'] }}"
                                            class="w-full text-[1rem]">{{ ucwords(str_replace('_', ' ', $stg['setting_name'])) }}</label>
                                        <input type="text" id="{{ $stg['setting_name'] }}"
                                            name="{{ $stg['setting_name'] }}" value="{{ $stg['setting_value'] }}"
                                            class="w-full rounded-[4px] !border-none bg-apae-gray/10 px-2 py-1 !outline-none">
                                    </div>
                                @endif
                            @endforeach

                            <div class="flex w-full flex-wrap justify-center gap-4 py-3">
                                <button type="submit"
                                    class="w-full rounded-sm bg-apae-green px-6 py-1 text-apae-white shadow-md dark:bg-apae-gray">
                                    Salvar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-span-2 md:col-span-1">
                    <div
                        class="bg-apae-white p-6 text-apae-gray-dark shadow-md dark:bg-apae-gray-dark dark:text-apae-white">
                        <h1 class="mb-2 text-[1.4rem] font-bold">Diretórios (Path)</h1>
                        <form action="{{ route('admin.settings.general.update-paths') }}" method="post"
                            class="flex flex-wrap gap-4">
                            @csrf
                            @method('PUT')
                            @foreach ($settings as $stg)
                                @if ($stg['setting_type'] === 'path')
                                    <div class="flex w-full flex-wrap p-1">
                                        <label for="{{ $stg['setting_name'] }}"
                                            class="w-full text-[1rem]">{{ ucwords(str_replace('_', ' ', $stg['setting_name'])) }}</label>
                                        <input type="text" id="{{ $stg['setting_name'] }}"
                                            name="{{ $stg['setting_name'] }}" value="{{ $stg['setting_value'] }}"
                                            class="w-full rounded-[4px] !border-none bg-apae-gray/10 px-2 py-1 !outline-none">
                                    </div>
                                @endif
                            @endforeach

                            <div class="flex w-full flex-wrap justify-center gap-4 py-3">
                                <button type="submit"
                                    class="w-full rounded-sm bg-apae-green px-6 py-1 text-apae-white shadow-md dark:bg-apae-gray">
                                    Salvar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    @endsection
</x-admin.app-default>
