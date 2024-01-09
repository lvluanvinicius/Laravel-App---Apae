<x-website.web-layout appTitle="" pageTitle="{{ $title }}">
    @section('content')

    <x-website.page-title title="{{$subtitle}}"/>

    <section class="flex justify-center">
        <div class="apae-container h-full mb-8">

            <form action="" class="bg-apae-white shadow-md shadow-apae-gray/40 rounded-md p-6 flex flex-col gap-4">
                <div class="form-group relative flex items-center">
                    <div class="flex items-center gap-1 absolute pl-3">
                        <i class="ph-bold text-[1.1rem] opacity-70 ph-identification-badge"></i>
                        <label class="opacity-70" for="name">Nome</label>
                    </div>
                    <input type="text" name="name" class="bg-apae-dark/10 rounded-md pl-24 w-full py-3 text-[1rem]" >
                </div>

                <div class="form-group relative flex items-center">
                    <div class="flex items-center gap-1 absolute pl-3">
                        <i class="ph-bold text-[1.1rem] opacity-70 ph-at"></i>
                        <label class="opacity-70" for="email">E-mail</label>
                    </div>
                    <input type="email" name="email" class="bg-apae-dark/10 rounded-md pl-24 w-full py-3 text-[1rem]" >
                </div>

                <div class="form-group relative flex items-center">
                    <div class="flex items-center gap-1 absolute pl-3">
                        <i class="ph-bold text-[1.1rem] opacity-70 ph-phone"></i>
                        <label class="opacity-70" for="tel">Telefone</label>
                    </div>
                    <input type="tel" name="tel" class="bg-apae-dark/10 rounded-md pl-28 w-full py-3 text-[1rem]" >
                </div>

                <div class="form-group relative flex items-center">
                    <div class="flex items-center gap-1 absolute pl-3">
                        <i class="ph-bold text-[1.1rem] opacity-70 ph-map-pin"></i>
                        <label class="opacity-70" for="city_uf">Cidade/UF</label>
                    </div>
                    <input type="text" name="city_uf" class="bg-apae-dark/10 rounded-md pl-32 w-full py-3 text-[1rem]" >
                </div>

                <div class="form-group relative flex items-center">
                    <div class="flex items-center gap-1 absolute pl-3">
                        <i class="ph-bold text-[1.1rem] opacity-70 ph-pencil-simple-line"></i>
                        <label class="opacity-70" for="subject">Assunto</label>
                    </div>
                    <input type="text" name="subject" class="bg-apae-dark/10 rounded-md pl-[6.8rem] w-full py-3 text-[1rem]" >
                </div>

                <div class="form-group relative flex items-start">
                    <div class="flex items-center gap-1 absolute pl-3 pt-2">
                        <i class="ph-bold text-[1.1rem] opacity-70 ph-chat-text"></i>
                        <label class="opacity-70" for="message">Mensagem</label>
                    </div>
                    <textarea type="text" name="message" class="bg-apae-dark/10 rounded-md pl-32 w-full py-3 text-[1rem]" cols="30" rows="5">
                    </textarea>
                </div>


            </form>

        </div>
    </section>

    @endsection
</x-website.web-layout>


