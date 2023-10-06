<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>管理ログイン画面</title>
    <link rel="stylesheet" href="{{ asset('admin_stylesheet.css') }}">
</head>
<body>
    <header>
       
    </header>
    <main>
        <div class="form-title">
            管理画面
        </div>

        <div class="errors">
            @if ($errors->any())
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
            @endif
        </div>

        <form action="{{ route('exeAdminLogin') }}" method="POST">
            @csrf
            <div class="form-item">
                <p>
                    <label>ログインID</label>
                    <input type="text" name="login_id" value="{{old('login_id')}}"/>
                </p>
            </div>

            <div class="form-item">
                <p>
                    <label>パスワード</label>
                    <input type="password" name="password" value=""/>
                </p>
            </div>
 
            <input type="submit" class="loginBtn" value="ログイン"/>
        </form>
    </main>
</body>
</html>