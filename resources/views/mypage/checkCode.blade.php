<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>認証コード入力</title>
    <link rel="stylesheet" href="{{ asset('stylesheet.css') }}">
</head>
<body>
    <header>
    </header>
    <main>
        <form action="" method="post">
            @csrf
            <div class="form-title">
                メールアドレス変更 認証コード入力
            </div>

            <div class="status">
                @if (session('status'))
                {{session('status')}}
                @endif
            </div>

            <div class="errors">
                @if ($errors->any())
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
                @endif
            </div>

            <div class="main_msg">
                <p>
                    （※メールアドレスの変更はまだ完了しておりません）<br>
                    変更後のメールアドレスにお送りしましたメールに記載されている「認証コード」を入力してください。
                </p>
            </div>

            <div class="form-item">
                <p>
                    <label>認証コード</label>
                    <input type="text" name="auth_code" value="{{old('auth_code')}}"/>
                </p>
            </div>

            <input type="submit" value="認証コードを送信してメールアドレスの変更を完了する" class="ChangeEmail">
        </form>
    </main>
</body>
</html>