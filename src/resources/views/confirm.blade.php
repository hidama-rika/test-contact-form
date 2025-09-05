@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}" />
@endsection

@section('header-nav')
@endsection

@section('content')
<div class="confirm__content">
    <div class="confirm__heading">
        <h2>Confirm</h2>
    </div>
    <form class="form" action="/contacts" method="post">
    @csrf
        <div class="confirm-table">
            <table class="confirm-table__inner">
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">お名前</th>
                    <td class="confirm-table__text">
                        <input type="text" name="name" value="{{ $validatedData['last_name'] }} {{ $validatedData['first_name'] }}" readonly />
                        <input type="hidden" name="last_name" value="{{ $validatedData['last_name'] }}" />
                        <input type="hidden" name="first_name" value="{{ $validatedData['first_name'] }}" />
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">性別</th>
                    <td class="confirm-table__text">
                        <input type="text" name="gender" value="{{ $validatedData['gender'] }}" readonly />
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">メールアドレス</th>
                    <td class="confirm-table__text">
                        <input type="email" name="email" value="{{ $validatedData['email'] }}" readonly />
                        <input type="hidden" name="email" value="{{ $validatedData['email'] }}" />
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">電話番号</th>
                    <td class="confirm-table__text">
                        <input type="hidden" name="tel" value="{{ $validatedData['tel'] }}" />
                        {{ $validatedData['tel'] }}
                        <input type="hidden" name="tel_part1" value="{{ $validatedData['tel_part1'] }}" />
                        <input type="hidden" name="tel_part2" value="{{ $validatedData['tel_part2'] }}" />
                        <input type="hidden" name="tel_part3" value="{{ $validatedData['tel_part3'] }}" />
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">住所</th>
                    <td class="confirm-table__text">
                        <input type="text" name="address" value="{{ $validatedData['address'] }}" readonly />
                        <input type="hidden" name="address" value="{{ $validatedData['address'] }}" />
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">建物名</th>
                    <td class="confirm-table__text">
                        <input type="text" name="building" value="{{ $validatedData['building'] }}" readonly />
                        <input type="hidden" name="building" value="{{ $validatedData['building'] }}" />
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">お問い合わせの種類</th>
                    <td class="confirm-table__text">
                        {{ $category->content }}
                        <input type="hidden" name="category_id" value="{{ $category->id }}" />
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">お問い合わせ内容</th>
                    <td class="confirm-table__text">
                        {{ $validatedData['detail'] }}
                        <input type="hidden" name="detail" value="{{ $validatedData['detail'] }}" />
                    </td>
                </tr>
            </table>
        </div>
        <div class="form__button--double">
            <div class="form__button">
                <button class="form__button-submit" type="submit">送信</button>
            </div>
            <div class="form__button">
                <button class="form__button-edit" type="button" onClick="history.back()">修正</button>
            </div>
        </div>
    </form>
</div>
@endsection
