@extends('layouts.app')
@section('content')
    <style>
        .row {
            margin: 14px 0;
        }

        .label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
        }

        .required {
            color: #d00;
            margin-left: .25em;
        }

        .fields {
            display: flex;
            gap: 8px;
        }

        .input {
            flex: 1 1 auto;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px
        }

        .error {
            color: #d00;
            font-size: 12px;
            margin-top: 4px;
        }

        .center {
            text-align: center
        }

        form {
            display: grid;
            grid-template-columns: 160px 1fr;
            gap: 12px 16px;
            align-items: center;
        }

        .row {
            display: contents;
        }

        .label {
            text-align: right;
            white-space: nowrap;
        }

        .fields {
            display: block;
        }

        .fields input,
        .fields select,
        .fields textarea {
            width: 100%;
            max-width: 520px;
        }

        .radios {
            display: flex;
            gap: 16px;
            align-items: center;
        }

        .radios label {
            display: inline-flex;
            gap: 6px;
            align-items: center;
        }

        .form-narrow {
            max-width: 720px;
            margin: 0 auto;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 160px 1fr;
            gap: 12px 16px;
            align-items: center;
        }

        .form-grid .fields input[type="text"],
        .form-grid .fields input[type="email"],
        .form-grid .fields input[type="tel"],
        .form-grid .fields select,
        .form-grid .fields textarea {
            width: 100%;
            max-width: 420px;
        }

        .form-grid .fields textarea {
            height: 140px;
        }

        .form-grid .fields.radios {
            display: flex;
            gap: 16px;
            align-items: center;
            -ms-flex-wrap: wrap;
        }

        .form-grid .fields input[type="radio"] {
            margin-right: 6px;
        }

        .form-grid .fields input[type="radio"]+label {
            margin-right: 16px;
            white-space: nowrap;
        }

        .form-grid .fields.gender {
            display: flex;
            gap: 16px;
            align-items: center;
            flex-wrap: wrap;
        }

        .form-grid .fields.gender .radio {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            white-space: nowrap;
        }

        .form-grid .fields.gender input[type="radio"] {
            margin: 0;
        }
    </style>

    <h1 class="page-title" style="text-align: center;color:#6b4e3d">Contact</h1>
    <form action="{{ route('contact.confirm') }}" method="post" class="form-grid form-narrow">
        @csrf
        <div class="row">
            <label class="label">お名前 <span class="required">※</span></label>
            <div class="fields">
                <input class="input" type="text" name="family_name" placeholder="姓"
                    value="{{ old('family_name', $data['family_name'] ?? '') }}">
                <input class="input" type="text" name="given_name" placeholder="名"
                    value="{{ old('given_name', $data['given_name'] ?? '') }}">
            </div>
            @error('family_name')
                <div class="error">{{ $message }}</div>
            @enderror
            @error('given_name')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        @php $g = old('gender', $data['gender'] ?? '1'); @endphp
        <div class="row">
            <label class="label">性別<span class="required">※</span></label>
            <div class="fields gender">
                <label class="radio"><input type="radio" name="gender" value="1"
                        {{ (string) $g === '1' ? 'checked' : '' }}>男性</label>

                <label class="radio"><input type="radio" name="gender" value="2"
                        {{ (string) $g === '2' ? 'checked' : '' }}>女性</label>

                <label class="radio"><input type="radio" name="gender" value="3"
                        {{ (string) $g === '3' ? 'checked' : '' }}>その他</label>
            </div>

            @error('gender')
                <div class="error">{{ $message }}
                </div>
            @enderror
        </div>

        <div class="row">
            <label class="label">メールアドレス <span class="required">※</span></label>
            <input class="input" type="email" name="email" value="{{ old('email', $data['email'] ?? '') }}">
            @error('email')
                <div class="error">{{ $message }}
                </div>
            @enderror
        </div>

        <div class="row">
            <label class="label">電話番号<span class="required">※</span></label>
            <input class="input" type="text" name="tel" inputmode="numeric" pattern="[0-9]*"
                value="{{ old('tel', $data['tel'] ?? '') }}">
            @error('tel')
                <div class="error">{{ $message }}
                </div>
            @enderror
        </div>

        <div class="row">
            <label class="label">住所<span class="required">※</span></label>
            <input class="input" type="text" name="address" value="{{ old('address', $data['address'] ?? '') }}">
            @error('address')
                <div class="error">{{ $message }}
                </div>
            @enderror
        </div>

        <div class="row">
            <label class="label">建物名</label>
            <input class="input" type="text" name="building" value="{{ old('building', $data['building'] ?? '') }}">
            @error('building')
                <div class="error">{{ $message }}
                </div>
            @enderror
        </div>

        <div class="row">
            <label class="label">お問い合わせの種類 <span class="required">※</span></label>
            <select class="input" name="category_id">
                <option value="">選択してください</option>
                @foreach ($categories as $id => $name)
                    <option value="{{ $id }}"
                        {{ (string) old('category_id', $data['category_id'] ?? '') === (string) $id ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <div class="error">{{ $message }}
                </div>
            @enderror
        </div>

        <div class="row">
            <label class="label">お問い合わせ内容<span class="required">※</span></label>
            <textarea class="input" name="detail" rows="5" maxlength="120" placeholder="120文字以内で入力してください">{{ old('detail', $data['detail'] ?? '') }}</textarea>
            @error('detail')
                <div class="error">{{ $message }}
                </div>
            @enderror
        </div>

        <div class="row center">
            <button type="submit" class="input" style="max-width: 220px;cursor:pointer">確認画面</button>
        </div>
    </form>
@endsection
