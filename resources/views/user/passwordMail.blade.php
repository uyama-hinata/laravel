<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>パスワード再設定画面</title>
    <link rel="stylesheet" href="{{ asset('stylesheet.css') }}">
</head>
<body>
    <main>
        <div class="main_msg">
            パスワード再設定用の URL を記載したメールを送信します。<br>
            ご登録されたメールアドレスを入力してください。
        </div>
        <form action="{{route('sendMail')}}" method="post">
            @csrf

            <div class="form-item">
                <p>
                    <label >メールアドレス</label>
                    <input type="email" name="email" value="{{old('email')}}"/>
                </p>
            </div>

            <div class="errors">
                @if ($errors->has('email'))
                {{ $errors->first('email') }}
                @endif
            </div>

            <input type="submit" class="btn_next" value="送信する"/>
            <a href="{{route('topLogout')}}" name="toLogout_btn" class="toTop">トップに戻る</a>
        </form>
    </main>
</body>
</html>