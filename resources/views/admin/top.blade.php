<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>管理者トップ画面</title>
    <link rel="stylesheet" href="{{ asset('admin_stylesheet.css') }}">
</head>
<body>
    <header>
        <div class="header_main_msg">管理画面メインメニュー</div>
        <div class="header_sub_msg">ようこそ {{$admin->name}} さん</div>
        <form action="{{route('adminLogout')}}" method="POST">
            @csrf
            <input type="submit" value="ログアウト" class="logout-button"/>
        </form>
    </header>
    <main>
        <a href="{{route('userList')}}" class="ToList">会員一覧</a>
        <a href="{{route('categoryList')}}" class="ToList">商品カテゴリ一覧</a>
    </main>
</body>
</html>