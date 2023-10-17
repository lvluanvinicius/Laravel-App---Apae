<x-admin.app-default app_title="" page_title="{{ $title }}">
    @section('content')
        <div class="px-8 mt-10">
            <div class="bg-apae-white dark:bg-apae-gray-dark shadow-md p-8">

                <form action="" method="POST">
                    @csrf

                    <div class="flex flex-wrap">
                        <label for="year-folder">Nome da Sessão: </label>
                        <input type="text" name="folder_session"  class="bg-apae-gray/10 px-2 py-1 w-full !border-none">
                    </div>

                    <div class="flex flex-wrap mt-4">
                        <button class="float-right px-6 shadow-md bg-apae-green dark:bg-apae-gray text-apae-white rounded-sm">Criar</button>
                    </div>
                </form>

            </div>
        </div>
    @endsection
</x-admin.app-default>
