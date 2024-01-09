<section class="z-10 flex h-[100vh] w-full items-center justify-center bg-apae-white shadow-md">
    <div class="apae-container flex h-full flex-col items-center justify-center py-10">

        <div class="w-full">
            <h1 class="text-[1.8rem] font-bold">Nossos Parceiros</h1>
            <div class="!h-[.3rem] w-[10rem] bg-apae-warning"></div>
        </div>

        <div class="my-[3rem] flex w-full flex-wrap justify-start gap-10 items-center">
            @foreach ($partners_data as $partner)
                <div class="flex flex-col justify-start">
                    <h1 class="font-[500] text-[1.2rem]">
                        {{ $partner->partner_name }}
                    </h1>
                    <div class="border p-4 h-[6rem] flex items-center justify-center">
                        <img class="w-[100%]" src="{{ Vite::partnersImages($partner->partner_image) }}" alt="">
                    </div>
                </div>
            @endforeach
        </div>

        <div class="w-full">
            <a href="" class="rounded-md bg-apae-cyan px-10 py-2 text-apae-white">Ver todos...</a>
        </div>

    </div>
</section>
