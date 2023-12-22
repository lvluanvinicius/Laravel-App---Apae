<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <meta name="description" content="Rede Apae - A maior rede de atendimento integral a pessoa com deficiência no Brasil.">
    <meta name="keywords" content="apae,apaes,rede apae,excepcional,acessibilidade,uniapae,deficiencia,deficiencia intelectual,pessoa com deficiencia,deficiente,sindrome de down,prevencao,inclusao,inclusao social,escola,escola especial,educacao,educacao especial,saude,crianca, Apae Chavantes">
    <meta name="robots" content="ALL">
    <meta name="rating" content="General">
    <meta name="author" content="Luan Vinícius Paiva dos Santos">
    <meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />

    {{-- // Vite config // --}}
    @vite(['resources/css/app.css', 'resources/css/website.css'])

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://unpkg.com/@phosphor-icons/web"></script>


    @yield('head')
    <title>{{ $pageTitle }}</title>
</head>
<body class="">
    <div>
        <x-website.header-top/>
        <x-website.header/>
        
        <main>
            @yield('content')
        </main>

        <x-website.footer/>
        <x-website.copy-right/>
    </div>


    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    @yield('js-content')
</body>
</html>