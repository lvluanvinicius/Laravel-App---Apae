<div class="fixed  z-50 h-full w-[16rem] border-r-[2px] border-apae-teal/10 shadow-md shadow-apae-dark/20 bg-apae-green">
    <div class="w-full flex justify-between items-center px-4 py-2 border-b border-apae-white/30">
        <div></div>
        <button class="text-apae-white bg-transparent !outline-0 !border-0">
            <i class="fa-regular fa-circle-xmark text-[1.3rem]"></i>
        </button>
    </div>
    <div class="w-full text-center py-2 flex justify-center">
        <a href="{{ route('home') }}" class="w-[80%] flex justify-center items-center">
            <img src="{{ Vite::appImages('logo-branca.webp') }}" alt="Logo Apae Chavantes" class="w-full "/>
        </a>
    </div>
    <div class="w-full h-full">
        <ul class="w-full text-apae-white">
            <a href="#">
                <li class="py-1 pl-2">Início</li>
            </a>
            
            <div class="py-1 pl-2" id="apae-link">
                Apae
            </div>
            <div class="border shadow-inner hidden" data-dropdown>
                <div>Link 01</div>
                <div>Link 02</div>
                <div>Link 03</div>
                <div>Link 04</div>
            </div>
        </ul>
    </div>
</div>


@section('js-content')
    <script>
        document.querySelector('#apae-link').addEventListener('click', function() {
            alert('teste')
            document.querySelector('ul[data-dropdown]').classList.toggle('hidden')
        })
    </script>
@endsection