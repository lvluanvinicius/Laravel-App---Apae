<div class="absolute w-[100vw] h-[100vh] flex justify-center items-center z-[9999] hidden" data-card-donate="donatenow">
    <div class="bg-apae-cyan shadow-lg shadow-apae-dark w-[60%] md:w-[40%] lg:w-[28%] h-[30rem] relative">
        
        <img src="{{Vite::qrcodeImages('cover/sendThumb.jpeg') }}" alt="" class="w-full h-full object-cover opacity-90">
        
        <div class="absolute top-0 left-0 h-full w-full z-10">
            <div class="bg-apae-green text-apae-white py-1 flex justify-between items-center px-4">
                <div>
                    <h1 class="text-[1.2rem] font-bold"></h1>
                </div>
                <button class="toggle-donatenow">
                    <i class="fa-regular fa-circle-xmark text-[1.3rem]"></i>
                </button>
            </div>

            <div class="h-full w-full flex justify-center items-center z-10">
                <img src="{{ Vite::qrcodeImages('exemplo.png') }}" alt=""
                    class="w-[50%]"/>
            </div>
        </div>

    </div>
</div>