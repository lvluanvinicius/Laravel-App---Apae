<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>


    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <meta name="viewport"
        content="width=device-width, height=device-height, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <meta name="description"
        content="Rede Apae - A maior rede de atendimento integral a pessoa com deficiência no Brasil.">
    <meta name="keywords"
        content="apae,apaes,rede apae,excepcional,acessibilidade,uniapae,deficiencia,deficiencia intelectual,pessoa com deficiencia,deficiente,sindrome de down,prevencao,inclusao,inclusao social,escola,escola especial,educacao,educacao especial,saude,crianca, Apae Chavantes">
    <meta name="robots" content="ALL">
    <meta name="rating" content="General">
    <meta name="author" content="Luan Vinícius Paiva dos Santos">
    <meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />

    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css"
        integrity="sha512-O03ntXoVqaGUTAeAmvQ2YSzkCvclZEcPQu1eqloPaHfJ5RuNGiS4l+3duaidD801P50J28EHyonCV06CUlTSag=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- // Vite config // --}}
    @vite(['resources/css/app.css', 'resources/css/website.css', 'resources/js/website.js'])

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://unpkg.com/@phosphor-icons/web"></script>


    @yield('head')
    <title>{{ $pageTitle }}</title>
</head>

<body class="relative">
    <div>
        <x-website.card-donate-now />
        <x-website.sidebar />
        <x-website.header-top />
        <x-website.header />

        <main>
            @yield('content')
        </main>

        <x-website.footer />
        <x-website.copy-right />
    </div>


    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"
        integrity="sha512-Zq9o+E00xhhR/7vJ49mxFNJ0KQw1E1TMWkPTxrWcnpfEFDEXgUiwJHIKit93EW/XxE31HSI5GEOW06G6BF1AtA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        
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
