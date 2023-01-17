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
                    <li class="common__name">
                        <label class="common__label" for="condition">
                            <input type="radio" name="condition" value="{{ $key }}">{{ $conditionName }}
                        </label>
                    </li>
                    @endforeach
                </ul>
            </li>
            <li class="common__search-sidebar">
                <p class="common__title"><img src="{{ asset('/storage/img/mens-mark.png') }}" alt="">メンズブランド</p>
                <ul class="common__list">
                    @foreach(config(MENS_BRAND) as $key => $brandName)
                    <li class="common__name">
                        <label class="common__label" for="{{ $brandName }}">
                            <input type="radio" name="{{ $brandName }}" value="{{ $key }}">{{ $brandName }}
                        </label>
                    </li>
                    @endforeach
                </ul>
            </li>
            <li class="common__search-sidebar">
                <p class="common__title"><img src="{{ asset('/storage/img/woman-mark.png') }}" alt="">レディースブランド</p>
                <ul class="common__list">
                    @foreach(config(MENS_BRAND) as $key => $brandName)
                    <li class="common__name">
                        <label class="common__label" for="{{ $brandName }}">
                            <input type="radio" name="{{ $brandName }}" value="{{ $key}}">{{ $brandName }}
                        </label>
                    </li>
                    @endforeach
                </ul>
            </li>
            <li class="common__search-sidebar common__search-sidebar--end">
                <p class="common__title">価格</p>
                <ul class="common__list">
                    @foreach(config(SORT) as $key => $sortName)
                    <li class="common__name">
                        <label class="common__label" for="{{ $sortName }}">
                            <input type="radio" name="{{ $sortName }}" value="{{ $key}}">{{ $sortName }}
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