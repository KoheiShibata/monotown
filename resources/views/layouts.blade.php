<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="shortcut icon" sizes="480x480" href="{{ asset('/storage/img/monotown-logo4.png') }}">
    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" href="/css/layout.css">
    <link rel="stylesheet" href="/css/base.css">
    @yield("css")
    <title>@yield("title")</title>
</head>

<body>
    <header class="header">
        <nav class="header-nav">
            <ul class="header__list">
                <li class="header__item">
                    <div class="header-logo">
                        <a href="/monotown">
                            <p>MONOTOWN</p>
                        </a>
                    </div>
                </li>
                <li class="header__item header__item--contact">
                    <a href="/contact">お問い合わせ</a>
                </li>
            </ul>
            <!-- hamburger -->
            <span class="hamburger__btn" id="hamburger__btn"></span>
        </nav>
    </header>

    <nav class="nav-search">
        <ul class="nav-search__menu">
            @foreach(config(CONDITION) as $key => $conditionName)
            <a href="/monotown?condition={{ $key }}">
                <li class="nav-search__item {{ session('condition') == $key ? 'nav-search__item--checked' : '' }}">
                    {{ $conditionName }}
                </li>
            </a>
            @endforeach
        </ul>
    </nav>

    @yield("main")

    <footer class="footer">
        <p>© 2023 s-kohei monotown</p>
    </footer>

    <script src="{{asset('/js/hamburgerMenu.js')}}"></script>
</body>

</html>