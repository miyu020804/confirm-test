@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}">


    <h1 class="page-title" style="text-align: text-align:center;color:#6b4e3d;">Confirm</h1>

    <div
        style="max-width: 720px;margin:0
    auto;background:#fff;border:1px solid
    #eee;padding:18px;border-radius:6px;">
        <dl class="kv" style="display: grid;gird-template-columns:160
    px 1fr;gap:8px 16px;">
            <dt>お名前</dt>
            <dd>{{ $data['family_name'] }}
                {{ $data['given_name'] }}</dd>
            @php
                $genderMap = ['1' => '男性', '2' => '女性', '3' => 'その他'];
            @endphp
            <dt>性別</dt>
            <dd>{{ $genderMap[(string) ($data['gender'] ?? '')] ?? '' }}</dd>


            <dt>メールアドレス</dt>
            <dd>{{ $data['email'] }}</dd>
            <dt>電話番号</dt>
            <dd>{{ $data['tel'] }}</dd>
            <dt>住所</dt>
            <dd>{{ $data['address'] }}</dd>
            <dt>建物名</dt>
            <dd>{{ $data['building'] }}</dd>
            <dt>お問い合わせの種類</dt>
            <dd>{{ $categoryName }}</dd>
            <dt>お問い合わせ内容"</dt>{!! nl2br(e($data['detail'])) !!}</dd>
        </dl>

        <div style="display: flex; gap:12px;
        justify-content:center; margin-top:18px;">
            <form action="{{ route('contact.index') }}" method="get">
                <button type="submit" class="btn-reset">修正する</button>
            </form>

            <form action="{{ route('contact.store') }}" method="post">
                @csrf
                <button type="submit">送信する</button>
            </form>
        </div>
    </div>
@endsection
