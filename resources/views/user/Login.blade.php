<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>ログイン画面</title>
    <link rel="stylesheet" href="{{ asset('stylesheet.css') }}">
</head>
<body>
    <main>
        <form action="{{ route('postLogin') }}" method="POST">
            @csrf
            <div class="form-title">
                ログイン
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

            <div class="form-item">
                <p>
                    <label>メールアドレス</label>
                    <input type="text" name="email" value="{{old('email')}}"/>
                </p>
            </div>

            <div class="form-item">
                <p>
                    <label>パスワード</label>
                    <input type="password" name="password" value=""/>
                </p>
            </div>

            
            <a href="{{route('passwordMail')}}" name="toPass_btn" class="toPass">パスワードを忘れた方はこちら</a>
            <input type="submit" class="btn_next" value="ログイン"/>
            <a href="{{route('topLogout')}}" name="toLogout_btn" class="toTop">トップに戻る</a>

        </form>
        
    </main>
</body>
</html>