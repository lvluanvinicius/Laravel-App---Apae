<x-admin.app-default app_title="" page_title="{{ $title }}">
    @section('head')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    @endsection
    @section('content')
        <div class="mx-2 mt-4 md:mx-8">
            <div class="w-full">

                <div class="w-full rounded bg-apae-white px-8 pb-8 pt-4 shadow-md dark:bg-apae-gray-dark">
                    <table class="table-responsive table w-full" id="table-users">
                        <thead>
                            <tr class="text-left">
                                <th>Nome</th>
                                <th>E-mail</th>
                                <th>Tema</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($users as $user)
                                <tr class="text-left">
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->ui_theme }}</td>
                                    <td>

                                        <div class="flex items-center justify-end gap-4">
                                            <a href="#" class="text-apae-cyan">
                                                <i class="fa-solid fa-user-pen"></i>
                                            </a>
                                            <button class="text-apae-danger" title="{{ 'Apagar ' . $user->name }}"
                                                idUser="{{ $user->id }}">
                                                <i class="fa-solid fa-user-xmark"></i>
                                            </button>

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    @endsection

    @section('js-content')
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
        <script>
            const tableUsers = new DataTable("#table-users");
        </script>
    @endsection
</x-admin.app-default>
