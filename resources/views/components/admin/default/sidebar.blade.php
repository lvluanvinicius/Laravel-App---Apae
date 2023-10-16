<aside class="fixed h-full w-[200px] apae-sidebar shadow-md shadow-apae-gray-dark text-apae-white bg-apae-green dark:bg-apae-gray-dark dark:text-apae-white">
    <div class="w-full p-4">
        <img src="{{ $logoPath }}" alt="{{ $appTitle }}" class="w-[100%]">
    </div>

    <div class="w-full mt-5">
        <ul>
            <a href="{{ route('admin.index') }}" class="">
                <li class="hover:border-l-2 pl-4 py-2 text-[.8rem]">
                    <i class="fa-solid fa-house"></i>
                    Painel
                </li>
            </a>
        </ul>
        <hr class="opacity-10 py-1"/>
        <ul>
            <li class="text-[.9rem] pl-2 py-2">Administração</li>      
            <a href="{{ route('admin.index') }}" class="">
                <li class="hover:border-l-2 pl-4 py-2 text-[.8rem]">
                    <i class="fa-solid fa-house"></i>
                    Painel
                </li>
            </a>

            <a href="{{ route('admin.transparency.index') }}" class="">
                <li class="hover:border-l-2 pl-4 py-2 text-[.8rem]">
                    <i class="fa-solid fa-eye"></i>
                    Transparência
                </li>
            </a>  
        </ul>
        <hr class="opacity-10 py-1"/>
        <ul>
            <li class="text-[.9rem] pl-2 py-2">Administração</li>     
        </ul>
    </div>
</aside>