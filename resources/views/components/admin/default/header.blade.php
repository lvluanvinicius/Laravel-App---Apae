<header class="apae-header w-full shadow-md py-2 px-3 bg-apae-white dark:bg-apae-gray dark:text-apae-white">
    <div class="flex justify-between items-center">
        <button class="px-2" id="class-toggle-sidebar">
            {{-- <i class="fa-solid fa-bars"></i> --}}
        </button>
        <div class="">
            <button onclick="changeTheme()" class="px-2" >
                <i class="fa-solid fa-circle-half-stroke"></i>
            </button>
            <a href="{{ env('APP_URL') }}" target="_blank" title="Ver Wersite">
                <i class="fa-solid fa-eye"></i>
            </a>
        </div>
    </div>
</header>

