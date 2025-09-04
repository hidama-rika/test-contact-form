@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}" />
@endsection

@section('header-nav')
@endsection

@section('content')
<div class="thanks-container">
    <div class="thanks__content">
        <div class="thanks__heading">
            <h2>お問い合わせありがとうございました</h2>
        </div>
    </div>
    <form action="/" method="get">
        <div class="form__button">
            <button class="form__button-submit" type="submit">HOME</button>
        </div>
    </form>
</div>
@endsection
