@extends("layouts")

@section("css")
<link href="{{ asset('css/contact.css') }}" rel="stylesheet">
@endsection

@section("title", "お問い合わせ")

@section("main")
<section class="contact-form">
    <h2 class="contact-form__title">お問い合わせ</h2>
    <div class="contact-form-wrap">
        <form action="/contact" method="post">
            @csrf
            <div class="form-group">
                <label for="name" class="contact-form__label">お名前</label><br>
                <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control">
                @if($errors->has("name"))
                <p class="error-message">{{ $errors->first("name") }}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="email" class="contact-form__label">メールアドレス</label><br>
                <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control">
                @if($errors->has("email"))
                <p class="error-message">{{ $errors->first("email") }}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="content" class="contact-form__label">お問い合わせ内容</label><br>
                <textarea name="content" id="content" class="form-control" rows="10">{{ old('content') }}</textarea>
            </div>
            @if($errors->has("content"))
            <p class="error-message">{{ $errors->first("content") }}</p>
            @endif

            <button type="submit">送信</button>
        </form>
    </div>
</section>
@endsection