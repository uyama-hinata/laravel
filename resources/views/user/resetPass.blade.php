<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>メール送信完了</title>
    <link rel="stylesheet" href="{{ asset('stylesheet.css') }}">
</head>
<body>
    <main>
        <form action="{{route('password.store')}}" method="POST">
            @csrf
            <div class="form-item">
                <p>
                    <label>パスワード</label>
                    <input type="password" name="password" value=""/>
                </p>
            </div>

            <div class="form-item">
                <p>
                    <label>パスワード確認</label>
                    <input type="password" name="password_confirmation" value=""/>
                </p>
            </div>

            <input type="submit" class="btn_next" value="パスワードリセット"/>
            <a href="{{route('topLogout')}}" name="toLogout_btn" class="toTop">トップに戻る</a>
        </form>
    </main>
    
</body>
</html>