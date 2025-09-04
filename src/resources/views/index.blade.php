@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}" />
@endsection

@section('header-nav')
@endsection

@section('content')
<div class="contact-form__content">
    <div class="contact-form__heading">
        <h2>Contact</h2>
    </div>
    <form class="form" action="/contacts/confirm" method="post">
        @csrf
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お名前</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
            <div class="form__input--text-split">
                <div class="form__input--lastname">
                    <input type="text" name="lastname" placeholder="例: 山田" value="{{ old('lastname') }}" />
                </div>
                <div class="form__input--firstname">
                    <input type="text" name="firstname" placeholder="例: 太郎" value="{{ old('firstname') }}" />
                    </div>
                    <div class="form__error">
                        @error('lastname')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                        @error('firstname')
                        <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">性別</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--radio">
                    <input type="radio" name="gender" id="male" value="男性" checked />
                    <label for="male">男性</label>
                    <input type="radio" name="gender" id="female" value="女性" />
                    <label for="female">女性</label>
                    <input type="radio" name="gender" id="other" value="その他" />
                    <label for="other">その他</label>
                </div>
                <div class="form__error">
                    @error('gender')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>

        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">メールアドレス</span>
                <span class="form__label--required">※</span>
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
                <span class="form__label--item">電話番号</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text-split">
                    <div class="form__input--tel">
                        <input type="tel" name="tel_part1" placeholder="080" value="{{ old('tel_part1') }}" />
                    </div>
                    <span>-</span>
                    <div class="form__input--tel">
                        <input type="tel" name="tel_part2" placeholder="1234" value="{{ old('tel_part2') }}" />
                    </div>
                    <span>-</span>
                    <div class="form__input--tel">
                        <input type="tel" name="tel_part3" placeholder="5678" value="{{ old('tel_part3') }}" />
                    </div>
                </div>
                <div class="form__error">
                    @error('tel')
                    <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">住所</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="address" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address') }}" />
                </div>
                <div class="form__error">
                    @error('address')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>

        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">建物名</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="building" placeholder="例: 千駄ヶ谷マンション101" value="{{ old('building') }}" />
                </div>
                <div class="form__error">
                    @error('building')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>

        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お問い合わせの種類</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--select">
                    <select name="category">
                        <option value="" disabled selected>選択してください</option>
                        <option value="１．商品のお届けについて">１．商品のお届けについて</option>
                        <option value="２．商品の交換について">２．商品の交換について</option>
                        <option value="３．商品トラブル">３．商品トラブル</option>
                        <option value="４．ショップへのお問い合わせについて">４．ショップへのお問い合わせについて</option>
                        <option value="その他">その他</option>
                    </select>
                </div>
                <div class="form__error">
                    @error('category')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>

        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お問い合わせ内容</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--textarea">
                    <textarea name="detail" placeholder="お問い合わせ内容をご記載ください">{{ old('detail') }}</textarea>
                </div>
                <div class="form__error">
                    @error('detail')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>

        <div class="form__button">
            <button class="form__button-submit" type="submit">確認画面</button>
        </div>
    </form>
</div>
@endsection
