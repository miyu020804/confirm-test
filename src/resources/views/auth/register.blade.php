<x-guest-layout>
    <!-- ヘッダー　-->
    <div class="header">
        <div class="logo">FashionablyLate</div>
        <x-slot name="logo"></x-slot>
        <a href="{{ route('login') }}" class="btn btn-login">Login</a>
    </div>

    <!-- 中央のカード -->
    <div class="main">
        <div class="form-container">
            <h2>Register</h2>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="mb-4">
                    <label for="name">お名前</label>
                    <input id="name" name="name" type="text" value="{{ old('name') }}"
                        class="w-full border" />
                    @error('name')
                        <p style="color:red; font-size: 14px;
                    margin-top: 4px;">
                            {{ $message }}</p>
                    @enderror
                </div>


                <!--Email Address -->
                <div class="mb-4">
                    <label for="email">メールアドレス</label>
                    <input id="email" name="email" type="email" value="{{ old('name') }}"
                        class="w-full border" />
                    @error('email')
                        <p style="color:red; font-size: 14px;
                    margin-top: 4px;">
                            {{ $message }}</p>
                    @enderror
                </div>


                <!-- Password -->
                <div class="mb-4">
                    <label for="password">パスワード</label>

                    <input id="password" name="password" type="password" class="w-full border" />
                    @error('password')
                        <p style="color:red; font-size: 14px;
                    margin-top: 4px;">
                            {{ $message }}</p>
                    @enderror
                </div>

                <!--送信＆ログインのリンク-->
                <div class="flex items-center
    justify-between">
                    <button type="submit" class="btn btn-register">登録</button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
