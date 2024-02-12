<div class="z-10 flex h-[6rem] w-full items-center justify-center bg-apae-white shadow-md">

    <div class="apae-container flex h-full justify-between">
        <a href="{{ route('home') }}" class="flex w-32 items-center lg:w-[12rem]">
            <img src="{{ asset('images/app/logo-preta.webp') }}" alt="Logo Apae Chavantes" class="w-full" />
        </a>

        <div class="hidden h-full w-full items-center justify-between font-[Roboto] lg:flex">
            <ul class="flex h-full flex-1 items-center justify-center font-medium">
                <button class="h-full">
                    <li
                        class="toggle-sidebar flex h-full cursor-pointer items-center justify-center border-b-[4px] border-transparent px-4 transition-all duration-700 hover:border-apae-orange">
                        <i class="ph ph-list text-[1.8rem]"></i>
                    </li>
                </button>
                <a href="{{ route('transparency.index') }}" class="h-full">
                    <li
                        class="flex h-full cursor-pointer items-center justify-center border-b-[4px] border-transparent px-4 transition-all duration-700 hover:border-apae-orange">
                        Transparência</li>
                </a>
                <a href="{{ route('photo-gallery.index') }}" class="h-full">
                    <li
                        class="flex h-full cursor-pointer items-center justify-center border-b-[4px] border-transparent px-4 transition-all duration-700 hover:border-apae-orange">
                        Galeria de Fotos</li>
                </a>
                <a href="{{ route('ombudsman.index') }}" class="h-full">
                    <li
                        class="flex h-full cursor-pointer items-center justify-center border-b-[4px] border-transparent px-4 transition-all duration-700 hover:border-apae-orange">
                        Ouvidoria</li>
                </a>
                <a href="{{ route('contact.index') }}" class="h-full">
                    <li
                        class="flex h-full cursor-pointer items-center justify-center border-b-[4px] border-transparent px-4 transition-all duration-700 hover:border-apae-orange">
                        Contato</li>
                </a>

            </ul>

            <x-website.donate-now />
        </div>

        <button class="toggle-sidebar bg-transparent focus:!border-0 focus:!outline-0 lg:hidden">
            <i class="fa-solid fa-bars-staggered fa-2x"></i>
        </button>
    </div>

</div>
