<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" href="/css/layout.css">
    <link rel="stylesheet" href="/css/base.css">
    <title>@yield("title")</title>
</head>

<body>
    <header class="header">
        <div class="header-logo">
            <p>monotown</p>
        </div>
    </header>

    @yield("main")
    
    <footer class="footer">
        <p>© 2023 monotown s-kohei</p>
    </footer>
</body>

</html>