<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>会員情報編集</title>
    <link rel="stylesheet" href="{{ asset('admin_stylesheet.css') }}">
</head>
<body>
    <header>
        <div class="header_main_msg">会員編集</div>
        
        <a href="{{route('userList')}}" class="toTop_btn">一覧へ戻る</a>
       
    </header>
    <main>
        <form action="{{route('adminPostEditer',['id'=>$user->id])}}" method="POST">
            @csrf
            
            <div class="errors">
                @if ($errors->any())
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
                @endif
            </div>
            
            <div class="form-item">
                <p>
                    ID
                    <label >{{$user->id}}</label>
                    <input type="hidden" name="id" value="{{$user->id}}">
                </p>
            </div>

            <div class="form-item">
                <p>
                    氏名
                    <label >姓</label>
                    <input type="text" name="name_sei" value="{{old('name_sei') ?? $user->name_sei}}"/>
                    <label>名</label>
                    <input type="text" name="name_mei" value="{{old('name_mei') ?? $user->name_mei}}"/>
                </p>
            </div>

            <div class="form-item">
                <p>
                    <label>ニックネーム</label>
                    <input type="text" name="nickname" value="{{old('nickname') ?? $user->nickname}}"/>
                </p>
            </div>

            <div class="form-item">
                <p>
                    性別
                    <label for="gender1">男性</label>
                    <input type="radio" name="gender" id="gender1" value="1" {{old('gender',$user->gender) == 1 ? 'checked' : ''}} />
                    <label for="gender2">女性</label>
                    <input type="radio" name="gender" id="gender2" value="2" {{old('gender',$user->gender) == 2 ? 'checked' : ''}} />
                </p>
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

            <div class="form-item">
                <p>
                    <label>メールアドレス</label>
                    <input type="text" name="email" value="{{old('email') ?? $user->email}}"/>
                </p>
            </div>
            
            <input type="submit" class="ToList" value="確認画面へ"/>

        </form>
    </main>
</body>
</html>