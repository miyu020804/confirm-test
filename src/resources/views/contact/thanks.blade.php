@extends('layouts.app', ['hideHeader' => true])
@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
    @endpush
    <div
        style="min-height: 60vh;display;flex;flex-direction:
    column;align-items;center;justify-content:center;gap:16px;">
        <p class="thanks-text;">お問い合わせありがとうございました。</p>
        <form action="{{ route('contact.index') }}" method="get">

            <button type="submit"
                style="display: inline-block;padding:10px
    18px;border:1px solid
    #e0d8cf;border-radius:6px;background:#fff;color:#6b4e3d;cursor:pointer;">HOME</button>
        </form>
    </div>
@endsection
