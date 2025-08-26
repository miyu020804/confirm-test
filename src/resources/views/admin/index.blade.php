<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <style>
        nav[role="navigation"]>div:first-child {
            display: none;
        }
    </style>
    <header class="admin-header">
        <h1 class="site-title">FashionablyLate</h1>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-btn">logout</button>
        </form>
    </header>

    <div class="admin-title">
        <h2>Admin</h2>
    </div>
</head>

<body>





    <form action="{{ route('admin.index') }}" method="get" style="margin-bottom:16px;">
        <div>
            名前:
            <input type="text" name="name" value="{{ request('name') }}">
            メール:
            <input type="text" name="email" value="{{ request('email') }}">
        </div>
        <div>
            性別:
            <select name="gender">
                @foreach ($genders as $k => $label)
                    <option value="{{ $k }}"
                        {{ (string) request('gender', 'all') === (string) $k ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>

            種別:
            <select name="category_id">
                <option value="">全て</option>
                @foreach ($categories as $id => $label)
                    <option value="{{ $id }}"
                        {{ (string) request('category_id') === (string) $id ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>

            日付:
            <input type="date" name="date" value="{{ request('date') }}">
        </div>
        <td class="button-cell">
            <button type="submit" class="btn
        btn-primary">検索</button>

            <button type="button" onclick="location.href='{{ route('admin.index') }}'"
                class="btn btn-secondary">リセット</button>
        </td>

        <a href="{{ route('admin.export', request()->query()) }}" style="margin-left: 8px;">エクスポート</a>
    </form>

    <p>件数: {{ $contacts->total() }}</p>

    @if ($contacts->count())
        <table border="1" cellpadding="6" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>お名前</th>
                    <th>性別</th>
                    <th>メール</th>
                    <th>お問い合わせの種類</th>
                    <th>登録日</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contacts as $c)
                    <tr>
                        <td>{{ $c->name }}</td>
                        <td>{{ $c->gender_label }}</td>
                        <td>{{ $c->email }}</td>
                        <td>{{ optional($c->category)->content }}</td>

                        <td>{{ optional($c->created_at)->format('Y-m-d') }}</td>
                        <td>
                            <button type="button" class="js-show" data-id="{{ $c->id }}">詳細</button>

                            <form action="{{ route('admin.destroy', $c->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('削除しますか?')">削除</button>

                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div style="margin-top: 12px;">
            {{ $contacts->links() }}
        </div>
    @else
        <p>データがありません</p>
    @endif

    <div id="modal" style="display:none;
position:fixed; inset:0;
background:rgba(0,0,0,.4);">
        <div style="background: #fff; width:600px;
max-width:90%; margin:10vh auto;
padding:16px; position:relative;">
            <button id="modalClose" style="position:absolute; right:8px;
top:8px;">×</button>
            @foreach ($contacts as $contact)
                <tr>
                    <td>{{ $contact->name }}</td>
                    <td><button class="detailBtn" data-id="{{ $contact->id }}">詳細</button></td>
                </tr>
            @endforeach
            <div id="modalBody">
                取得中…
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.detailBtn').forEach(btn => {
            console.log(btn);
        });
        document.addEventListener('DOMContentLoaded',
            () => {
                const detailBtns =
                    document.querySelectorAll('.detailBtn');
                const modal =
                    document.getElementById('modal');
                const modalClose =
                    document.getElementById('modalClose');

                detailBtns.forEach(btn => {
                    btn.addEventListener('click', () => {
                        modal.style.display = 'block';
                    });
                });

                modalClose.addEventListener('click', (e) => {
                    if (e.target === modal) {
                        modal.style.display = 'none';
                    }
                });

            });
    </script>
</body>

</html>
