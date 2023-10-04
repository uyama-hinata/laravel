<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>退会ページ</title>
    <link rel="stylesheet" href="{{ asset('stylesheet.css') }}">
</head>
<body>
    <header>
        <form action="{{route('logout')}}" method="POST">
            @csrf
            <a href="{{route('topLogin')}}">トップに戻る</a>
            <input type="submit" value="ログアウト" class="logout-button"/>
        </form>
    </header>
    <main>
        <div class="thank_msg"><p>退会します。よろしいでしょうか？</p></div>
        <a href="{{route('mypage')}}" class="back_review">マイページに戻る</a>
        <form action="{{route('exeDelete')}}" method="POST">
            @csrf
            <input type="submit" value="退会する" class="toRegisterReview" >
        </form>
    </main>
</body>
</html>