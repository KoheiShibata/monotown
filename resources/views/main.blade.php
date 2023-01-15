@extends("layouts")

@section("css")
<link href="{{ asset('css/main.css') }}" rel="stylesheet">
@endsection

@section("title", "MONOTOWN")


@section("main")
<section class="wrapper">
    <aside class="search-sidebar">
        <div class="total-result">
            <h1>対象商品<br><span>{{ $totalResults }}</span>件</h1>
        </div>
        <ul>
            <li class="common__search-sidebar">
                <p class="common__title">商品状態</p>
                <ul class="common__list">
                    @foreach(config(CONDITION) as $key => $name)
                    <li class="common__name">
                        <label class="common__label" for="{{ $name }}">
                            <input type="checkbox" name="{{ $name }}" value="{{ $key }}">{{ $name }}
                        </label>
                    </li>
                    @endforeach
                </ul>
            </li>
            <li class="common__search-sidebar">
                <p class="common__title">メンズブランド</p>
                <ul class="common__list">
                    @foreach(config(MENS_BRAND) as $key => $name)
                    <li class="common__name">
                        <label class="common__label" for="{{ $name }}">
                            <input type="checkbox" name="{{ $name }}" value="{{ $key }}">{{ $name }}
                        </label>
                    </li>
                    @endforeach
                </ul>
            </li>
            <li class="common__search-sidebar">
                <p class="common__title">レディースブランド</p>
                <ul class="common__list">
                    @foreach(config(MENS_BRAND) as $key => $name)
                    <li class="common__name">
                        <label class="common__label" for="{{ $name }}">
                            <input type="checkbox" name="{{ $name }}" value="{{ $key}}">{{ $name }}
                        </label>
                    </li>
                    @endforeach
                </ul>
            </li>
            <li class="common__search-sidebar">
                <p class="common__title">価格</p>
                <ul class="common__list">
                    @foreach(config(SORT) as $key => $name)
                    <li class="common__name">
                        <label class="common__label" for="{{ $name }}">
                            <input type="checkbox" name="{{ $name }}" value="{{ $key}}">{{ $name }}
                        </label>
                    </li>
                    @endforeach
                </ul>
            </li>  
        </ul>
    </aside>

    <main class="sale">
        <ul class="sale__list">
            @foreach($itemDatas as $data)
            <li class="sale__item">
                <!-- <a href="{{ $data['url'] }}">
                </a> -->
                <a href="#">
                    <img src="{{ $data['image'] }}" alt="">
                    <p class="{{ $data['condition'] == 'used' ? 'color--red' : '' }}">{{ $data["price"] }}</p>
                </a>
            </li>
            @endforeach
        </ul>
    </main>

</section>
@endsection