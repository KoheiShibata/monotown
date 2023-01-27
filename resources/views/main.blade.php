@extends("layouts")

@section("css")
<link href="{{ asset('css/main.css') }}" rel="stylesheet">
@endsection

@section("title", "MONOTOWN")


@section("main")
<section class="wrapper">
    <aside class="search-sidebar" id="search-sidebar">
        <div class="total-result">
            <h1>対象商品<br><span>{{ $totalResults }}</span>件</h1>
        </div>
        <ul>
            <li class="common__search-sidebar">
                <p class="common__title">商品状態</p>
                <ul class="common__list">
                    @foreach(config(CONDITION) as $key => $conditionName)
                    <a href="/monotown?condition={{ $key }}">
                        <li class="common__name {{ session('condition') == $key ? 'common__name--checked' : '' }}">
                            {{ $conditionName }}
                        </li>
                    </a>
                    @endforeach
                </ul>
            </li>
            <li class="common__search-sidebar">
                <p class="common__title">価格</p>
                <ul class="common__list">
                    @foreach(config(SORT) as $key => $sortName)
                    <a href="/monotown?sort={{ $key }}">
                        <li class="common__name {{ urlencode(session('sort')) ==  $key ? 'common__name--checked' : ''}}">
                            {{ $sortName }}
                        </li>
                    </a>
                    @endforeach
                </ul>
            </li>
            <li class="common__search-sidebar">
                <p class="common__title common__title--mens">メンズブランド</p>
                <ul class="common__list">
                    @foreach(config(MENS_BRAND) as $key => $mensBrandName)
                    <a href="/monotown?mensBrand={{ $key }}&name={{ $mensBrandName }}">
                        <li class="common__name {{ session('mensBrand') == $key ? 'common__name--checked' : ''}}">
                            {{ $mensBrandName }}
                        </li>
                    </a>
                    @endforeach
                </ul>
            </li>
            <li class="common__search-sidebar">
                <p class="common__title common__title--woman">レディースブランド</p>
                <ul class="common__list">
                    @foreach(config(MENS_BRAND) as $key => $brandName)
                    <li class="common__name">
                        {{ $brandName }}
                    </li>
                    @endforeach
                </ul>
            </li>
            <li class="common__search-sidebar common__search-sidebar--end">
                <ul class="common__list common__list--contact">
                    <li class="common__name">
                        <a href="/contact">お問い合わせ</a> 
                    </li>
                </ul>
            </li>
        </ul>
    </aside>

    <main class="main">
        <section class="sale">
            <ul class="sale__list">
                @foreach($itemDatas as $data)
                <li class="sale__item">
                    <a href="{{ $data['url'] }}">
                        <img src="{{ $data['image'] }}" alt="">
                        <p class="{{ $data['condition'] == 'used' ? 'color--red' : '' }}">{{ $data["price"] }}</p>
                    </a>
                </li>
                @endforeach
            </ul>
        </section>
        <section class="post">
            <h2 class="post__title"><img src="{{ asset('/storage/img/instagram-icon-1.png') }}" alt=""><span>公式アカウント投稿</span></h2>
            <ul class="post__list">
                @foreach($postDatas as $data)
                <li class="post__item">
                    <a href="{{ $data['page_url'] }}">
                        <img src="{{ $data['image'] }}" alt="">
                    </a>
                </li>
                @endforeach
            </ul>
        </section>
    </main>
</section>
@endsection