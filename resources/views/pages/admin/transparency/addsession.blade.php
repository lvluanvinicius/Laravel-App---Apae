<x-admin.app-default app_title="" page_title="{{ $title }}">
    @section('content')
        <div class="mx-2 mt-4 md:mx-8">
            <div class="bg-apae-white p-8 shadow-md dark:bg-apae-gray-dark">

                <form
                    action="{{ route('admin.transparency.create-folder-session-store', ['folderYearId' => request('folderYearId')]) }}"
                    method="POST">
                    @csrf

                    <div class="mb-4 flex flex-wrap">
                        <h1>
                            <span class="font-bold uppercase">Ano:{{ '' }}</span>
                            <span>{{ $year->year_folder }}</span>
                        </h1>
                    </div>


                    <div class="flex flex-wrap">
                        <label for="year-folder">Nome da Sessão: </label>
                        <input type="text" name="folder_session" class="w-full !border-none bg-apae-gray/10 px-2 py-1">
                    </div>

                    <div class="mt-4 flex flex-wrap gap-4">
                        <a href="{{ route('admin.transparency.index') }}"
                            class="float-right rounded-sm bg-apae-green px-6 text-apae-white shadow-md dark:bg-apae-gray">Cancelar</a>
                        <button
                            class="float-right rounded-sm bg-apae-green px-6 text-apae-white shadow-md dark:bg-apae-gray">Criar</button>
                    </div>
                </form>

            </div>
        </div>
    @endsection
</x-admin.app-default>
