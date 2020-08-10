<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>АВТОРАЗБОРОВ</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{asset('images/logo.png')}}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="shortcut icon" href="{{asset('images/logo.png')}}" type="image/png">
    <link rel="stylesheet" href="{{asset('css/lib.css')}}">
    <link rel="stylesheet" href="{{asset('css/index.css')}}">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper" style="position: static">
    <div class="gray_bg" style="position: absolute; opacity: 0.7; z-index: 1" class="w-100 h-100"></div>
    <img src="{{ asset('images/bg.jpg') }}" class="w-100 h-100" alt="bg" style="position: absolute">
    <nav class="main-header navbar navbar-expand">
        <div class="row w-100 ml-2">
            <div class="col-xl-4 col-lg-4 col-md-12 d-flex justify-content-center">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <p class="service_info" style="display:none">Сервис поиска запчастей <span class="underline">по всем</span>
                            <span class="underline"> авторазборкам</span> и магазинам</p>
                    </li>
                </ul>
            </div>
    </nav>
    <!-- Main Sidebar Container -->
    <aside style="z-index: 0; background: none" class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="#" class="brand-link d-flex logo" id="logo">
            <img src="{{ asset('images/logo.png') }}" alt="Logo">
            <p>АВТОРАЗБОРОВ</p>
        </a>
        <nav id="mt_regul" style="margin-top: 20px">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a class="nav-link">
                        <p>
                            Подать заяку на поиск
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link">
                        <p>
                            Поданные заявки
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
    </aside>
</div>
@yield('content')
<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
</body>
</html>

