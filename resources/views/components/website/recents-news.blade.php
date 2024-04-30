<div class="col-span-2 md:col-span-1">
    <div class="p-1 text-apae-white">
        <h1 class="mb-2 text-[1.5rem]">Últimas postagens</h1>

        <div class="mb-2 flex flex-col gap-3 px-2">
            @foreach ($news as $ns)
                <a href="{{ route('app.blog') . '/' . $ns->id }}" class="flex">
                    <div class="flex h-[5rem] w-[5rem] items-center justify-center px-2">
                        <img class="w-full" src="https://avatars.githubusercontent.com/u/44438249?v=4" alt="">
                    </div>
                    <div class="w-full flex-1 px-1">
                        <h3 class="text-bold mt-2 text-[.9rem]">{{ $ns->news_post_title }}</h3>
                        <p class="truncate-2-lines w-[100%] text-[.8rem] text-apae-white/70">
                            {{ $ns->news_post_summary }}</p>
                    </div>
                </a>
            @endforeach
        </div>

    </div>

    <a href="{{ route('app.blog') }}" class="rounded-[4px] bg-apae-orange px-4 py-2 text-apae-white shadow-md">
        Ver Todas
    </a>

</div>
