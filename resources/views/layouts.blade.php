<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" sizes="480x480" href="{{ asset('/storage/img/monotown-logo4.png') }}">
    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" href="/css/layout.css">
    <link rel="stylesheet" href="/css/base.css">
    @yield("css")
    <title>@yield("title")</title>
</head>

<body>
    <header class="header">
        
        <div class="header-logo">
            <p>MONOTOWN</p>
        </div>

        <!-- hamburger -->
            <span class="hamburger__btn" id="hamburger__btn"></span>
    </header>

    <nav class="nav-search">
        <ul class="nav-search__menu">
            @foreach(config(CONDITION) as $key => $conditionName)
            <li class="nav-search__item">
                <label class="condition__label" for="condition">
                    <input type="radio" name="condition" value="{{ $key }}">{{ $conditionName }}
                </label>
            </li>
            @endforeach
        </ul>
    </nav>

    @yield("main")

    <footer class="footer">
        <p>© 2023 s-kohei monotown</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="{{asset('/js/hamburgerMenu.js')}}"></script>
    <script src="{{asset('/js/radioCheck.js')}}"></script>
</body>

</html>