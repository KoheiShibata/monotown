@extends("layouts")

@section("css")
<link href="{{ asset('css/main.css') }}" rel="stylesheet">
@endsection

@section("title", "MONOTOWN")


@section("main")
<main class="main">
    <aside class="serch-sidebar">
        <section class="serch-sidebar__type">
            <ul class="mens-brand__list">
                <li class="mens-brand__name">

                </li>
            </ul>
        </section>
    </aside>

    <section class="sale">
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
    </section>

</main>
@endsection