<div class="hidden-sidebar fixed z-50 h-full w-full border-r-[2px] border-apae-teal/10 bg-apae-green shadow-md shadow-apae-dark/20 transition-all duration-500 md:w-[15rem]"
    data-sidebar="sidebar">
    <div class="flex w-full items-center justify-between border-b border-apae-white/30 px-4 py-2">
        <div></div>
        <button class="toggle-sidebar !border-0 bg-transparent text-apae-white !outline-0">
            <i class="fa-regular fa-circle-xmark text-[1.3rem]"></i>
        </button>
    </div>
    <div class="flex w-full justify-center py-2 text-center">
        <a href="{{ route('home') }}" class="flex w-[80%] items-center justify-center">
            <img src="{{ Vite::appImages('logo-branca.webp') }}" alt="Logo Apae Chavantes" class="w-full" />
        </a>
    </div>
    <div class="mb-2 flex flex-col items-center gap-2 border-b border-apae-white/30 pb-2">
        <x-website.donate-now />

        <a href="{{ route('login') }}"
            class="flex h-[2rem] w-[10rem] items-center justify-center rounded-md bg-apae-teal text-apae-white">Entrar</a>
    </div>
    <div class="h-full w-full !overflow-auto">
        <ul class="w-full text-apae-white">
            <a href="{{ route('home') }}">
                <li class="py-2 pl-2">Início</li>
            </a>

            <li class="flex cursor-pointer items-center py-2 pl-2" id="apae-link">
                Apae
                <i class="fa-solid fa-chevron-down ml-4 text-[.7rem]"></i>
            </li>
            <li class="hidden bg-apae-gray-dark/10 shadow-inner transition-all duration-700" data-dropdown="apae-link">
                <a href="{{route('apae.institutional')}}">
                    <div class="py-2 pl-2">Institucional</div>
                </a>
                <a href="{{route('apae.direction')}}">
                    <div class="py-2 pl-2">Diretoria</div>
                </a>
                <a href="{{route('apae.advice')}}">
                    <div class="py-2 pl-2">Conselho</div>
                </a>
                <a href="{{route('apae.statute')}}">
                    <div class="py-2 pl-2">Estatuto</div>
                </a>
            </li>

            <a href="#">
                <li class="py-2 pl-2">Transparência</li>
            </a>

            <a href="{{ route('photo-gallery.index') }}">
                <li class="py-2 pl-2">Galeria de Fotos</li>
            </a>

            <a href="#">
                <li class="py-2 pl-2">Notícias</li>
            </a>

            <a href="#">
                <li class="py-2 pl-2">Parceiros</li>
            </a>

            <li class="flex cursor-pointer items-center px-2 py-2" id="lgpd-link">
                LGPD
                <i class="fa-solid fa-chevron-down ml-4 text-[.7rem]"></i>
            </li>
            <li class="hidden bg-apae-gray-dark/10 shadow-inner transition-all duration-700" data-dropdown="lgpd-link">
                <a href="#">
                    <div class="py-2 pl-2">Política de Privacidade</div>
                </a>
                <a href="#">
                    <div class="py-2 pl-2">Termos de Uso</div>
                </a>
            </li>

            <a href="#">
                <li class="py-2 pl-2">Contato</li>
            </a>
        </ul>
    </div>


</div>
