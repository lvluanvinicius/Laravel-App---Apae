<div class="h-[6rem] bg-apae-white shadow-md w-full flex justify-center items-center z-10">

    <div class="apae-container h-full flex justify-between">
        <a href="{{ route('home') }}" class="w-32 lg:w-[12rem] flex items-center">
            <img src="{{ Vite::appImages('logo-preta.webp') }}" alt="Logo Apae Chavantes" class="w-full"/>
        </a>

        <div class="w-full h-full hidden lg:flex justify-between items-center font-[Roboto]">
            <ul class="flex items-center justify-center h-full font-medium flex-1">
                <a href="#" class="h-full">
                    <li class="flex items-center justify-center h-full px-4 border-b-[4px] border-transparent transition-all duration-700 hover:border-apae-orange">Apae</li>
                </a>
                <a href="#" class="h-full">
                    <li class="flex items-center justify-center h-full px-4 border-b-[4px] border-transparent transition-all duration-700 hover:border-apae-orange">Transparência</li>
                </a>
                <a href="#" class="h-full">
                    <li class="flex items-center justify-center h-full px-4 border-b-[4px] border-transparent transition-all duration-700 hover:border-apae-orange">Galeria de Fotos</li>
                </a>
                <a href="#" class="h-full">
                    <li class="flex items-center justify-center h-full px-4 border-b-[4px] border-transparent transition-all duration-700 hover:border-apae-orange">Notícias</li>
                </a>
                <a href="#" class="h-full">
                    <li class="flex items-center justify-center h-full px-4 border-b-[4px] border-transparent transition-all duration-700 hover:border-apae-orange">Contato</li>
                </a>
            </ul>

            <x-website.donate-now/>
        </div>

        <button class="bg-transparent lg:hidden focus:!outline-0 focus:!border-0">
            <i class="fa-solid fa-bars-staggered fa-2x"></i>
        </button>
    </div>
    
</div>