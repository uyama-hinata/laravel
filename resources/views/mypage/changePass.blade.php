<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>パスワード変更</title>
    <link rel="stylesheet" href="{{ asset('stylesheet.css') }}">
</head>
<body>
    <header>
    </header>
    <main>
        <form action="{{route('exeChangePass')}}" method="post">
            @csrf
            <div class="form-title">
                パスワード変更
            </div>

            <div class="errors">
                @if ($errors->any())
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
                @endif
            </div>

            <div class="form-item">
                <p>
                    <label>パスワード</label>
                    <input type="password" name="password" value=""/>
                </p>
            </div>

            <div class="form-item">
                <p>
                    <label> パスワード確認</label>
                    <input type="password" name="password_confirmation" value=""/>
                </p>
            </div>
            <input type="submit" value="パスワードを変更" class="toRegisterReview">
        </form>
        <a href="{{route('mypage')}}" class="back_review">マイページに戻る</a>
    </main>
</body>
</html>