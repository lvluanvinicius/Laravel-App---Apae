<x-login.login-layout app_title="" page_title="{{ $title }}">
    @section('content')
        <div class="flex h-[100vh] w-[100vw] flex-wrap justify-center dark:bg-black dark:text-white" id="box-form-login">

            <x-login.header />

            <div
                class="flex h-[400px] w-[300px] flex-col items-center rounded-xl border border-apae-dark/20 bg-apae-white py-6 shadow-lg shadow-apae-gray-dark/20 sm:h-[500px] sm:w-[400px] md:h-[500px] md:w-[450px]">

                <div class="flex justify-center">
                    <img src="{{ asset('images/app/logo-preta.webp') }}" alt="" class="w-[50%]">
                </div>

                <div class="mt-10 w-[80%]">
                    <form action="{{ route('login-do') }}" method="POST">

                        @csrf

                        <div class="flex flex-wrap">
                            <label for="email" class="font-bold opacity-50">E-mail</label>

                            <input type="email" name="email" id="email" name="email" required
                                value="{{ old('email') }}"
                                class="w-full rounded-md border border-apae-dark/20 px-2 text-[1rem] placeholder:opacity-40" />
                        </div>
                        @if ($errors->any())
                            <span class="text-apae-danger">{{ $errors->get('email')[0] }}</span>
                        @endif

                        <div class="flex flex-wrap">
                            <label for="password" class="mt-4 font-bold opacity-50">Senha</label>

                            <input type="password" name="password" id="password" name="password" required
                                class="w-full rounded-md border border-apae-dark/20 px-2 text-[1rem] placeholder:opacity-40" />
                        </div>
                        @if ($errors->any())
                            <span class="text-apae-danger">{{ $errors->get('password')[0] }}</span>
                        @endif

                        <div class="mt-5 flex flex-wrap">
                            <button type="submit"
                                class="w-full rounded-md bg-apae-gray-dark/30 py-1 text-apae-light">Entrar</button>
                        </div>

                    </form>

                </div>
                @if (session('message'))
                    <span class="mt-4 text-apae-danger">{{ session('message') }}</span>
                @endif

            </div>
        </div>
    @endsection
</x-login.login-layout>
