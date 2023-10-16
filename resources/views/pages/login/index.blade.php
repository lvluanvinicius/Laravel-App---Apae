<x-login.login-layout app_title="" page_title="{{ $title }}">
    @section('content')
        <div class="border w-[100vw] h-[100vh] flex flex-wrap justify-center  dark:bg-black dark:text-white"
            id="box-form-login">

            <x-login.header />

            <div
                class="py-6 md:w-[25vw] bg-apae-white w-[70vw] h-[60vh] shadow-lg shadow-apae-gray-dark/20 rounded-md border border-apae-dark/20">

                <div class="flex justify-center">
                    <img src="{{ Vite::appImages('logo-preta.webp') }}" alt="" class="w-[50%]">
                </div>

                <div class="p-10">
                    <form action="{{ route('login-do') }}" method="POST">

                        @csrf

                        <div class="flex flex-wrap">
                            <label for="email" class=" font-bold opacity-50">E-mail</label>

                            <input type="email" name="email" id="email" name="email" required value="luan@grupocednet.com.br"
                                class="w-full border-apae-dark/20 text-[1.3rem] border placeholder:opacity-40 px-2" />
                        </div>

                        <div class="flex flex-wrap">
                            <label for="password" class="mt-4 font-bold opacity-50">Senha</label>

                            <input type="password" name="password" id="password" name="password" required value="1234"
                                class="w-full border-apae-dark/20 text-[1.3rem] border placeholder:opacity-40 px-2" />
                        </div>

                        <div class="flex flex-wrap mt-5">
                            <button type="submit"
                                class="bg-apae-gray-dark/30 text-apae-light w-full rounded-md py-1">Entrar</button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    @endsection
</x-login.login-layout>
