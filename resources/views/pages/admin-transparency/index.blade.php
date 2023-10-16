<x-admin.app-default app_title="" page_title="{{ $title }}">
    @section('content')
        <div class="mx-8 mt-4">
            <div class="grid grid-cols-12">
                <div class="hidden md:block md:col-span-6 col-span-2 px-3 md:py-0 py-3"></div>

                <div class="md:col-span-6 col-span-12 px-3 md:py-0 py-3">
                    <div class="bg-apae-white dark:bg-apae-gray-dark px-4 pt-4 pb-8 shadow-md">
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
                    <div class="bg-apae-white dark:bg-apae-gray-dark p-4 shadow-md">

                        <ul class="p-4">
                            {{-- @foreach ($years as $item)
                                <li class="flex items-center cursor-pointer">
                                    <span class="mr-2" id="folderIcon1" onclick="toggleFolder('{{ $item->year_folder }}')">
                                        <i class="fas fa-folder text-blue-500 text-apae-yellow"></i>
                                        <span class="font-bold">{{ $item->year_folder }}</span>
                                    </span>
                                </li>
                                <ul class="ml-6" id="{{ $item->year_folder }}" style="display: none;">
                                    <li class="flex items-center">
                                        <span class="mr-2">
                                            <i class="fas fa-file text-gray-600 text-apae-cyan"></i>
                                        </span>
                                        <span>Arquivo1.txt</span>
                                    </li>
                                    <li class="flex items-center">
                                        <span class="mr-2">
                                            <i class="fas fa-file text-gray-600 text-apae-cyan"></i>
                                        </span>
                                        <span>Arquivo2.txt</span>
                                    </li>
                                </ul>
                            @endforeach --}}

                            {{-- @foreach ($years as $y)
                                <li class="flex items-center cursor-pointer">
                                    <span class="mr-2" id="folderIcon1" onclick="toggleFolder('{{ $y->year_folder }}')">
                                        <i class="fas fa-folder text-blue-500 text-apae-yellow"></i>
                                        <span class="font-bold">{{ $y->year_folder }}</span>
                                    </span>
                                </li>
                                @foreach ($folders as $fd) 
                                                                    
                                    <ul class="ml-6" id="{{ $y->year_folder }}" style="display: none;">
                                        <li class="flex items-center cursor-pointer">
                                            <span class="mr-2" id="folderIcon1" onclick="toggleFolder('{{ $fd->folders }}')">
                                                <i class="fas fa-folder text-blue-500 text-apae-yellow"></i>
                                                <span class="font-bold">{{ $fd->folders }}</span>
                                            </span>
                                        </li>
                                        <ul class="ml-6" id="{{ $fd->folders }}" style="display: none;">
                                            @foreach ($files as $fs) 
                                                <li class="flex items-center">
                                                    <span class="mr-2">
                                                        <i class="fas fa-file text-gray-600 text-apae-cyan"></i>
                                                    </span>
                                                    <span>{{ $fs->filename }}</span>
                                                </li> 
                                            @endforeach
                                        </ul>
                                    </ul>

                                @endforeach
                            @endforeach --}}


                            @foreach ($transparency as $transp)
                                <li class="flex items-center cursor-pointer">
                                    <span class="mr-2" id="folderIcon1" onclick="toggleFolder('{{ $transp['year_folder'] }}')">
                                        <i class="fas fa-folder text-blue-500 text-apae-yellow"></i>
                                        <span class="font-bold">{{ $transp['year_folder'] }}</span>
                                    </span>
                                </li>   
                                @foreach ($transp['folders'] as $trp)
                                    <ul class="ml-6" id="{{ $transp['year_folder'] }}" style="display: none;">
                                        <li class="flex items-center cursor-pointer">
                                            <span class="mr-2" id="folderIcon1" onclick="toggleFolder('{{ $trp['folders'] }}')">
                                                <i class="fas fa-folder text-blue-500 text-apae-yellow"></i>
                                                <span class="font-bold">{{ $trp['folders'] }}</span>
                                            </span>
                                        </li>
                                    </ul>
                                @endforeach
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

                if (folder.style.display === 'none' || folder.style.display === '') {
                    folder.style.display = 'block';
                    // folderIcon.innerHTML = '<i class="fas fa-folder-open text-blue-500"></i>';
                } else {
                    folder.style.display = 'none';
                    // folderIcon.innerHTML = '<i class="fas fa-folder text-blue-500"></i>';
                }
            }
        </script>
    @endsection

</x-admin.app-default>
