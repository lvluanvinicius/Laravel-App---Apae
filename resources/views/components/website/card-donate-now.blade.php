<div class="fixed z-[99999] flex hidden h-[100%] w-[100%] items-center justify-center bg-apae-gray-dark/30"
    data-card-donate="donatenow">
    <div class="relative h-[30rem] w-[60%] bg-apae-cyan shadow-lg shadow-apae-dark md:w-[40%] lg:w-[28%]">

        <img src="{{ asset('images/qrcode/cover/sendThumb.jpeg') }}" alt=""
            class="h-full w-full object-cover opacity-90">

        <div class="absolute left-0 top-0 z-10 h-full w-full">
            <div class="flex items-center justify-between bg-apae-green px-4 py-1 text-apae-white">
                <div>
                    <h1 class="text-[1.2rem] font-bold"></h1>
                </div>
                <button class="toggle-donatenow">
                    <i class="fa-regular fa-circle-xmark text-[1.3rem]"></i>
                </button>
            </div>

            <div class="z-10 flex h-full w-full items-center justify-center">
                <img src="{{ asset('images/qrcode/exemplo.png') }}" alt="" class="w-[50%]" />
            </div>
        </div>

    </div>
</div>
