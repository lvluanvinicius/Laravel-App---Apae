<div class="hidden-sidebar fixed z-50 h-full w-full border-r-[2px] border-apae-white/20 bg-apae-teal shadow-xl shadow-apae-dark transition-all duration-500 md:w-[18rem]"
    data-sidebar="sidebar">
    <div class="flex w-full items-center justify-between border-b border-apae-white/30 px-4 py-2">
        <div></div>
        <button class="toggle-sidebar !border-0 bg-transparent text-apae-white !outline-0">
            <i class="fa-regular fa-circle-xmark text-[1.3rem]"></i>
        </button>
    </div>
    <div class="flex w-full justify-center py-2 text-center">
        <a href="{{ route('home') }}" class="flex w-[80%] items-center justify-center">
            <img src="{{ asset('images/app/logo-branca.webp') }}" alt="Logo Apae Chavantes" class="w-full" />
        </a>
    </div>
    <div class="mb-2 flex flex-col items-center gap-2 border-b border-apae-white/30 pb-2">
        <x-website.donate-now />

        <div class="w-full px-4">
            <input type="text" placeholder="Pesquisar"
                class="input-search-website h-[30px] w-full rounded-md text-apae-dark">
        </div>
    </div>
    <div class="h-full w-full">
        <ul class="content-sidebar h-[65%] w-full overflow-y-auto pb-6 text-apae-white">
            <a href="{{ route('home') }}">
                <li class="py-2 pl-2 text-[1.1rem]">Início</li>
            </a>

            <li class="flex cursor-pointer items-center py-2 pl-2 text-[1.1rem]" id="apae-link">
                Apae
                <i class="fa-solid fa-chevron-down ml-4 text-[.7rem]"></i>
            </li>
            <li class="hidden bg-apae-gray-dark/10 shadow-inner transition-all duration-700" data-dropdown="apae-link">
                <a href="{{ route('apae.institutional') }}">
                    <div class="py-2 pl-2 text-[1.1rem]">Institucional</div>
                </a>
                <a href="{{ route('apae.direction') }}">
                    <div class="py-2 pl-2 text-[1.1rem]">Diretoria</div>
                </a>
                <a href="{{ route('apae.advice') }}">
                    <div class="py-2 pl-2 text-[1.1rem]">Conselho</div>
                </a>
                <a href="{{ route('apae.statute') }}">
                    <div class="py-2 pl-2 text-[1.1rem]">Estatuto</div>
                </a>
            </li>

            <a href="{{ route('transparency.index') }}">
                <li class="py-2 pl-2 text-[1.1rem]">Transparência</li>
            </a>

            <a href="{{ route('photo-gallery.index') }}">
                <li class="py-2 pl-2 text-[1.1rem]">Galeria de Fotos</li>
            </a>

            <a href="#">
                <li class="py-2 pl-2 text-[1.1rem]">Notícias</li>
            </a>

            <a href="#">
                <li class="py-2 pl-2 text-[1.1rem]">Parceiros</li>
            </a>

            <li class="flex cursor-pointer items-center px-2 py-2" id="lgpd-link">
                LGPD
                <i class="fa-solid fa-chevron-down ml-4 text-[.7rem]"></i>
            </li>
            <li class="hidden bg-apae-gray-dark/10 shadow-inner transition-all duration-700" data-dropdown="lgpd-link">
                <a href="#">
                    <div class="py-2 pl-2 text-[1.1rem]">Política de Privacidade</div>
                </a>
                <a href="#">
                    <div class="py-2 pl-2 text-[1.1rem]">Termos de Uso</div>
                </a>
            </li>

            <a href="{{ route('contact.index') }}">
                <li class="py-2 pl-2 text-[1.1rem]">Contato</li>
            </a>
        </ul>
    </div>


</div>
