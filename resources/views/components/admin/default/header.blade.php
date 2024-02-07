<header class="apae-header w-full bg-apae-white px-6 py-2 shadow-md dark:bg-apae-gray dark:text-apae-white">
    <div class="flex items-center justify-between">
        <button class="class-toggle-sidebar px-2">
            <i class="fa-solid fa-bars"></i>
        </button>
        <div class="">
            <button onclick="changeTheme()" class="px-2">
                <i class="fa-solid fa-circle-half-stroke"></i>
            </button>
            <a href="{{ env('APP_URL') }}" target="_blank" title="Ver Wersite">
                <i class="fa-solid fa-eye"></i>
            </a>
        </div>
    </div>
</header>
