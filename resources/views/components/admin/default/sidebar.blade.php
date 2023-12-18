<aside class="fixed h-full w-[200px] apae-sidebar shadow-md shadow-apae-gray-dark text-apae-white bg-apae-green dark:bg-apae-gray-dark dark:text-apae-white">
    <div class="w-full p-4">
        <img src="{{ $logoPath }}" alt="{{ $appTitle }}" class="w-[100%]">
    </div>

    <div class="w-full mt-5">
        <ul>
            <a href="{{ route('admin.index') }}" class="">
                <li class="hover:border-l-2 pl-4 py-2 text-[.8rem]">
                    <i class="fa-solid fa-house mr-1"></i>
                    Painel
                </li>
            </a>
        </ul>
        <hr class="opacity-10 py-1"/>
        <ul>
            <li class="text-[.9rem] pl-2 py-2">Website</li>
            <a href="{{ route('admin.photos-gallery.index') }}" class="">
                <li class="hover:border-l-2 pl-4 py-2 text-[.8rem]">
                    <i class="fa-solid fa-images mr-1"></i>
                    Galeria de Fotos
                </li>
            </a> 

            <a href="{{ route('admin.transparency.index') }}" class="">
                <li class="hover:border-l-2 pl-4 py-2 text-[.8rem]">
                    <i class="fa-solid fa-eye mr-1"></i>
                    Transparência
                </li>
            </a>  

            <a href="{{ route('admin.partners.index') }}" class="">
                <li class="hover:border-l-2 pl-4 py-2 text-[.8rem]">
                    <i class="fa-regular fa-handshake mr-1"></i>
                    Parceiros
                </li>
            </a>  
            <a href="{{ route('admin.news.index') }}" class="">
                <li class="hover:border-l-2 pl-4 py-2 text-[.8rem]">
                    <i class="fa-solid fa-newspaper mr-1"></i>
                    Notícias
                </li>
            </a>

            <a href="{{ route('admin.sliders.index') }}" class="">
                <li class="hover:border-l-2 pl-4 py-2 text-[.8rem]">
                    <i class="fa-regular fa-images mr-1"></i>
                    Sliders
                </li>
            </a>  
        </ul>
        <hr class="opacity-10 py-1"/>
        <ul>
            <li class="text-[.9rem] pl-2 py-2">Administração</li>
            <a href="{{ route('admin.settings.general.index') }}" class="">
                <li class="hover:border-l-2 pl-4 py-2 text-[.8rem]">
                    <i class="fa-solid fa-gear"></i>
                    Configurações
                </li>
            </a>  
            <a href="{{ route('admin.users.index') }}" class="">
                <li class="hover:border-l-2 pl-4 py-2 text-[.8rem]">
                    <i class="fa-solid fa-users mr-1"></i>
                    Usuários
                </li>
            </a> 
        </ul>
    </div>
</aside>