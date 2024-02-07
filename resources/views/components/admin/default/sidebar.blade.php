<aside
    class="apae-sidebar fixed z-[999] h-full w-[200px] bg-apae-green text-apae-white shadow-md shadow-apae-gray-dark dark:bg-apae-gray-dark dark:text-apae-white">
    {{-- <div class="flex justify-end">
        <button class="class-toggle-sidebar px-2">
            <i class="fa-solid fa-angles-left"></i>
        </button>
    </div> --}}
    <div class="w-full p-4">
        <img src="{{ $logoPath }}" alt="{{ $appTitle }}" class="w-[100%]">
    </div>

    <div class="mt-5 w-full">
        <ul>
            <a href="{{ route('admin.index') }}" class="">
                <li class="border-l-2 border-transparent py-2 pl-4 text-[.8rem] hover:border-apae-white">
                    <i class="fa-solid fa-house mr-1"></i>
                    Painel
                </li>
            </a>
        </ul>
        <hr class="py-1 opacity-10" />
        <ul>
            <li class="py-2 pl-2 text-[.9rem]">Website</li>
            <a href="{{ route('admin.photos-gallery.index') }}" class="">
                <li class="border-l-2 border-transparent py-2 pl-4 text-[.8rem] hover:border-apae-white">
                    <i class="fa-solid fa-images mr-1"></i>
                    Galeria de Fotos
                </li>
            </a>

            <a href="{{ route('admin.transparency.index') }}" class="">
                <li class="border-l-2 border-transparent py-2 pl-4 text-[.8rem] hover:border-apae-white">
                    <i class="fa-solid fa-eye mr-1"></i>
                    Transparência
                </li>
            </a>

            <a href="{{ route('admin.partners.index') }}" class="">
                <li class="border-l-2 border-transparent py-2 pl-4 text-[.8rem] hover:border-apae-white">
                    <i class="fa-regular fa-handshake mr-1"></i>
                    Parceiros
                </li>
            </a>
            <a href="{{ route('admin.news.index') }}" class="">
                <li class="border-l-2 border-transparent py-2 pl-4 text-[.8rem] hover:border-apae-white">
                    <i class="fa-solid fa-newspaper mr-1"></i>
                    Notícias
                </li>
            </a>

            <a href="{{ route('admin.sliders.index') }}" class="">
                <li class="border-l-2 border-transparent py-2 pl-4 text-[.8rem] hover:border-apae-white">
                    <i class="fa-regular fa-images mr-1"></i>
                    Sliders
                </li>
            </a>
        </ul>
        <hr class="py-1 opacity-10" />
        <ul>
            <li class="py-2 pl-2 text-[.9rem]">Administração</li>
            <a href="{{ route('admin.settings.general.index') }}" class="">
                <li class="border-l-2 border-transparent py-2 pl-4 text-[.8rem] hover:border-apae-white">
                    <i class="fa-solid fa-gear"></i>
                    Configurações
                </li>
            </a>
            <a href="{{ route('admin.users.index') }}" class="">
                <li class="border-l-2 border-transparent py-2 pl-4 text-[.8rem] hover:border-apae-white">
                    <i class="fa-solid fa-users mr-1"></i>
                    Usuários
                </li>
            </a>
        </ul>
    </div>
</aside>
