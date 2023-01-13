@extends("layouts")

@section("css")
<link href="{{ asset('css/main.css') }}" rel="stylesheet">
@endsection

@section("title", "MONOTOWN")


@section("main")
<main class="main">
    @foreach($datas["hits"] as $data)
    <p>{{ $data["name"] }}</p>
    @endforeach
</main>