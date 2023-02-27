<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" href="/css/error.css">
    <title>Not Found</title>
</head>
<body>
    <main class="error">
        <section class="error__wrapper">
            <img src="{{ asset('/storage/img/monotown-logo2.png') }}" alt="">
            <div class="error__title">
                <h2>404</h2>
                <p>Not Found</p>
            </div>
            <div class="error__desc">
                <p>ご指定のページが見つかりません。<br>
                monotownをご利用いただきありがとうございます。<br>
                申し訳ございませんが、検索中のページは存在しないか、<br>
                名前変更のため一時的にご利用が不可能です。</p>
                <a href="{{ route('monotown') }}">トップページに戻る</a>
            </div>
        </section>
    </main>
</body>
</html>