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
    @vite(['resources/css/app.css'])

    <title>{{ $pageTitle }}</title>
</head>
<body class="">
    <div>
        <x-website.header/>
        
        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>