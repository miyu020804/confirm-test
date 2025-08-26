<x-guest-layout>
    <div class="header">
        <div class="logo">FashionablyLate</div>
        <a href="{{ route('register') }}" class="btn btn-login">Register
        </a>
    </div>

    <div class="main">
        <div class="form-container">
            <h2>Login</h2>

            <form method="POST" action="{{ route('login') }}" novalidate>
                @csrf

                <label for="email">メールアドレス</label>

                <input id="email" type="email" name="email" value="{{ old('email') }}">
                @error('email')
                    <div style="color:red;">{{ $message }}</div>
                @enderror

                <label for="password">パスワード</label>
                <input id="password" type="password" name="password">
                @error('password')
                    <div style="color:red;">{{ $message }}</div>
                @enderror

                <button type="submit" class="btn
                btn-register">ログイン</button>
            </form>
        </div>
    </div>
</x-guest-layout>
