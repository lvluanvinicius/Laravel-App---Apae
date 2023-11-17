<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous"
        referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css"
        integrity="sha512-O03ntXoVqaGUTAeAmvQ2YSzkCvclZEcPQu1eqloPaHfJ5RuNGiS4l+3duaidD801P50J28EHyonCV06CUlTSag=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css"
        integrity="sha256-sWZjHQiY9fvheUAOoxrszw9Wphl3zqfVaz1kZKEvot8=" crossorigin="anonymous">

    @yield('head')

    @vite(['resources/css/app.css', 'resources/css/app-mobile.css', 'resources/js/app.js'])

    <script>
 
        // Ação para alterar o tema visual da aplicação.
       function changeTheme() {
            const FormChangeTheme = document.createElement('form');
            FormChangeTheme.action = `{{ route('admin.iThemes') }}`;
            FormChangeTheme.method = "POST";
            
            const FormInputMethod = document.createElement('input');
            FormInputMethod.value = 'PUT';
            FormInputMethod.name = '_method';
            FormInputMethod.type = 'hidden';
            

            const FormInputToken = document.createElement('input');
            FormInputToken.value = `{{ csrf_token() }}`;
            FormInputToken.name = '_token';
            FormInputToken.type = 'hidden';

            FormChangeTheme.appendChild(FormInputMethod);
            FormChangeTheme.appendChild(FormInputToken);

            document.body.appendChild(FormChangeTheme);
            FormChangeTheme.submit(); // Enviando requisição.
        }
    </script>


    <title>{{ $pageTitle }}</title>
</head>

<body class="bg-apae-back-light dark:!bg-apae-gray dark:!text-apae-light {{ $iThemes }}">

    <x-admin.default.sidebar logoPath="{{ $logoPath }}" />

    <main class="ml-[200px] apae-content h-[100vh] bg-apae-dark/10 dark:bg-apae-gray dark:text-apae-light overflow-auto">
        <x-admin.default.header />

        @yield('content')
    </main>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"
        integrity="sha512-Zq9o+E00xhhR/7vJ49mxFNJ0KQw1E1TMWkPTxrWcnpfEFDEXgUiwJHIKit93EW/XxE31HSI5GEOW06G6BF1AtA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"
        integrity="sha256-t0FDfwj/WoMHIBbmFfuOtZv1wtA977QCfsFR3p1K4No=" crossorigin="anonymous"></script>

    @yield('js-content')
    

    {{-- Recuperando valor de error vindo do request. --}}
    @if ($errors->any())
        <script>
            const errors = @json($errors->all());
            for (let i = 0; i < errors.length; i++) {
                iziToast.error({
                    title: "Ooops!",
                    message: errors[i],
                    position: 'topRight'
                });
            }
        </script>
    @endif

    {{-- Feedback ao usuário sobre a ação executada.  --}}
    @if (session('message') && session('type'))
        <script>
            let type = "{{ session('type') }}"; // Recupera o status.
            // Caso o status seja de sucesso, será exibido uma mensagem do tipo Success.
            if (type === "Success") {
                iziToast.success({
                    title: "Eeeeh!",
                    message: "{{ session('message') }}",
                    position: 'topRight'
                });
            }
            // Retorna status de aviso.
            else if (type === "Warning") {
                iziToast.warning({
                    title: "Aviso!",
                    message: "{{ session('message') }}",
                    position: 'topRight'
                });
            }
            // Retornar uma mensagem de erro caso o tipo seja Error.
            else {
                iziToast.error({
                    title: "Ooops!",
                    message: "{{ session('message') }}",
                    position: 'topRight'
                });
            }
        </script>
    @endif
</body>

</html>
