<x-admin.app-default app_title="" page_title="{{ $title }}">
    @section('content')
        <div class="mx-8 mt-4">
            <div class="grid grid-cols-12">


                <div class="md:col-span-6 col-span-12 px-3 md:py-0 py-3">
                    <div class="bg-apae-white dark:bg-apae-gray-dark px-8 pt-4 pb-8 shadow-md">
                        <form action="{{ route('admin.transparency.create-folder-year') }}" method="post">
                            @csrf
                            <div class="flex gap-3 flex-wrap items-center">
                                <div class="flex justify-between w-full">
                                    <label for="year-folder">Novo Ano: </label>
                                    <button
                                        class="float-right px-6 shadow-md bg-apae-green dark:bg-apae-gray text-apae-white rounded-sm">Criar</button>
                                </div>
                                <input type="text" name="year_folder" id="year-folder"
                                    class="bg-apae-gray/10 px-2 py-1 w-full !border-none"
                                    placeholder="Ex: {{ date('Y') }}" value="{{ old('year_folder') }}" />
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>

        <div class="mx-8 mt-4">
            <div class="grid grid-cols-2">
                <div class="col-span-2 px-3">
                    <div class="bg-apae-white dark:bg-apae-gray-dark p-8 shadow-md">

                        <ul class="p-4 shadow-inner dark:shadow-apae-white/10 overflow-auto h-[500px]">

                            @foreach ($transparency as $transp)
                                <li class="flex items-center justify-between cursor-pointer">
                                    <div class="flex justify-start items-center">
                                        <span class="mr-2" id="folderIcon{{ $transp['year_folder'] }}"
                                        onclick="toggleFolder('{{ $transp['year_folder'] }}')">
                                        <i class="fas fa-folder text-blue-500 text-apae-yellow"></i>
                                    </span>
                                    <span class="font-bold">{{ $transp['year_folder'] }}</span>
                                    <a href="{{ route('admin.transparency.create-folder-session', ['folderYearId' => $transp['id']]) }}"
                                        title="Adicionar Sessão" class="!p-0 text-[.8rem] ml-4">
                                        Adicionar Sessão +
                                    </a>
                                    </div>

                                    <button onclick="destroyFolderYear({{ $transp['id'] }})" title="Apagar Sessão">
                                        <i class="fa-solid fa-trash text-apae-danger"></i>
                                    </button>

                                </li>
                                <ul class="ml-6" id="{{ $transp['year_folder'] }}" style="display: block;">
                                    @foreach ($transp['folders'] as $trp)
                                        <li class="flex items-center justify-between ">
                                            <div class="flex items-center justify-between w-full cursor-pointer">
                                                <div class="flex justify-start items-center">
                                                    <span class="mr-2" id="folderIcon{{ $trp['hash'] }}"
                                                        onclick="toggleFolder('{{ $trp['hash'] }}')">
                                                        <i class="fas fa-folder text-blue-500 text-apae-yellow"></i>
                                                    </span>
                                                    <span class="font-bold">{{ $trp['folders'] }}</span>
                                                    <a href="{{ route('admin.transparency.create-file-session', ['folderSession' => $trp['id']]) }}"
                                                        class="!p-0 text-[.8rem] ml-4">Novo arquivo +</a>
                                                </div>

                                                <button onclick="destroyFolderSession({{ $trp['id'] }})" title="Apagar Sessão">
                                                    <i class="fa-solid fa-trash text-apae-danger"></i>
                                                </button>
                                            </div>

                                        </li>
                                        <ul class="ml-6" id="{{ $trp['hash'] }}" style="display: none;">
                                            @foreach ($trp['files'] as $fs)
                                                <li
                                                    class="flex items-center justify-between border-b dark:border-apae-white/10 border-apae-dark/10">
                                                    <div class="flex items-center justify-start">
                                                        <span class="mr-2">
                                                            <i class="fas fa-file text-gray-600 text-apae-cyan"></i>
                                                        </span>
                                                        <span class="">{{ $fs->filename }}</span>
                                                    </div>

                                                    <div class="flex items-center gap-4">
                                                        <button onclick="destroyFileSession({{ $fs->id }})"
                                                            title="Apagar Arquivo">
                                                            <i class="fa-solid fa-trash text-apae-danger"></i>
                                                        </button>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endforeach
                                </ul>
                            @endforeach
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    @endsection


    @section('js-content')
        <script>
            function toggleFolder(id) {
                const folder = document.getElementById(id);
                const folderIcon = document.getElementById(`folderIcon${id}`);
                if (folder) {

                    if (folder.style.display === 'none' || folder.style.display === '') {
                        folder.style.display = 'block';
                        folderIcon.innerHTML = '<i class="fas fa-folder-open text-blue-500 text-apae-yellow"></i>';
                    } else {
                        folder.style.display = 'none';
                        folderIcon.innerHTML = '<i class="fas fa-folder text-blue-500 text-apae-yellow"></i>';
                    }
                }
            }

            function destroyFileSession(file) {
                if (confirm('Deseja realmente apagar esse Documento?')) {
                    const FormDeleteFile = document.createElement('form');
                    FormDeleteFile.action = `{{ route('admin.transparency.destroy-file-session', ['fileId' => '__FILE__']) }}`
                        .replace('__FILE__', file);
                    FormDeleteFile.method = "POST";

                    const FormInputMethod = document.createElement('input');
                    FormInputMethod.value = 'DELETE';
                    FormInputMethod.name = '_method';
                    FormInputMethod.type = 'hidden';


                    const FormInputToken = document.createElement('input');
                    FormInputToken.value = `{{ csrf_token() }}`;
                    FormInputToken.name = '_token';
                    FormInputToken.type = 'hidden';

                    FormDeleteFile.appendChild(FormInputMethod);
                    FormDeleteFile.appendChild(FormInputToken);

                    document.body.appendChild(FormDeleteFile);
                    FormDeleteFile.submit(); // Enviando requisição.
                }
            }

            function destroyFolderSession(folder) {
                if (confirm('Deseja realmente apagar essa Sessão?')) {
                    const FormDeleteFolder = document.createElement('form');
                    FormDeleteFolder.action = `{{ route('admin.transparency.destroy-folder-session', ['folderSession' => '__FOLDER__']) }}`
                        .replace('__FOLDER__', folder);
                    FormDeleteFolder.method = "POST";

                    const FormInputMethod = document.createElement('input');
                    FormInputMethod.value = 'DELETE';
                    FormInputMethod.name = '_method';
                    FormInputMethod.type = 'hidden';


                    const FormInputToken = document.createElement('input');
                    FormInputToken.value = `{{ csrf_token() }}`;
                    FormInputToken.name = '_token';
                    FormInputToken.type = 'hidden';

                    FormDeleteFolder.appendChild(FormInputMethod);
                    FormDeleteFolder.appendChild(FormInputToken);

                    document.body.appendChild(FormDeleteFolder);
                    FormDeleteFolder.submit(); // Enviando requisição.
                }
            }

            function destroyFolderYear(folderYear) {
                if (confirm('Deseja realmente apagar esse Ano?')) {
                    const FormDeleteFolderYear = document.createElement('form');
                    FormDeleteFolderYear.action = `{{ route('admin.transparency.destroy-folder-year', ['folderYearId' => '__YEAR__']) }}`
                        .replace('__YEAR__', folderYear);
                    FormDeleteFolderYear.method = "POST";

                    const FormInputMethod = document.createElement('input');
                    FormInputMethod.value = 'DELETE';
                    FormInputMethod.name = '_method';
                    FormInputMethod.type = 'hidden';


                    const FormInputToken = document.createElement('input');
                    FormInputToken.value = `{{ csrf_token() }}`;
                    FormInputToken.name = '_token';
                    FormInputToken.type = 'hidden';

                    FormDeleteFolderYear.appendChild(FormInputMethod);
                    FormDeleteFolderYear.appendChild(FormInputToken);

                    document.body.appendChild(FormDeleteFolderYear);
                    FormDeleteFolderYear.submit(); // Enviando requisição.
                }
            }
        </script>
    @endsection

</x-admin.app-default>
