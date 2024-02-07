<section class="z-10 flex h-[400px] w-full items-center justify-center bg-apae-white shadow-md">
    <div class="apae-container flex h-full flex-col items-center justify-center py-10">

        <div class="w-full">
            <h1 class="text-[1.8rem] font-bold text-apae-blue-default">Nossos Parceiros</h1>
            <div class="!h-[.3rem] w-[10rem] bg-apae-warning"></div>
        </div>

        <div class="my-[3rem] flex w-full items-center justify-start gap-1">
            @foreach ($partners_data as $partner)
                <div class="flex h-[200] w-[140px] flex-col justify-start">
                    <div class="flex h-[100px] w-[100%] items-center justify-center p-4">
                        <img class="w-[100%]" src="{{ asset('images/partners/' . $partner->partner_image) }}"
                            alt="{{ $partner->partner_name }}">
                    </div>
                </div>
            @endforeach
        </div>

        <div class="w-full">
            <a href="" class="rounded-md bg-apae-orange px-10 py-2 text-apae-white">Ver todos...</a>
        </div>

    </div>
</section>
