@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/common.css') }}" />
<link rel="stylesheet" href="{{ asset('css/login.css') }}" />
@endsection

@section('header-nav')
<div class="form__button-nav">
    <nav>
        <a href="{{ route('register') }}" class="form__button-register">register</a>
    </nav>
</div>
@endsection

@section('content')
<div class="contact-form__content">
    <div class="contact-form__heading">
        <h2>Login</h2>
    </div>
    <!-- novalidateを追加してブラウザの自動バリデーションを無効にする -->
    <form class="form" action="/login" method="post" novalidate>
    @csrf
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">メールアドレス</span>
                <span class="form__label--required"></span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="email" name="email" placeholder="例: test@example.com" value="{{ old('email') }}" />
                </div>
                <div class="form__error">
                    @error('email')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>

        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">パスワード</span>
                <span class="form__label--required"></span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="password" name="password" placeholder="例: coachtech1106" />
                </div>
                <div class="form__error">
                    @error('password')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>

        <div class="form__button">
            <button class="form__button-submit" type="submit">ログイン</button>
        </div>
    </form>
</div>
@endsection
