<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>会員情報編集</title>
    <link rel="stylesheet" href="{{ asset('admin_stylesheet.css') }}">
</head>
<body>
    <header>
        @if(empty($user->id))
            <div class="header_main_msg">会員登録</div>
        @else
            <div class="header_main_msg">会員編集</div>
        @endif   

        <a href="{{route('userList')}}" class="toTop_btn">一覧へ戻る</a>
       
    </header>
    <main>
        @if(empty($user->id))
            <form action="{{ route('adminPostUser') }}" method="POST">
        @else
            <form action="{{route('adminPostEditer',['id'=>$user->id])}}" method="POST">
        @endif     
        
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
                    @if(empty($user->id))
                        登録後に自動採番
                    @else
                        {{$user->id}}
                        <input type="hidden" name="id" value="{{$user->id}}">
                    @endif
                </p>
            </div>

            <div class="form-item">
                <p>
                    氏名
                    <label >姓</label>
                    <input type="text" name="name_sei" value="@if(empty($user->id)){{old('name_sei')}}@else{{old('name_sei') ?? $user->name_sei}}@endif"/>
                    <label>名</label>
                    <input type="text" name="name_mei" value="@if(empty($user->id)){{old('name_mei')}}@else{{old('name_mei') ?? $user->name_mei}}@endif"/>
                </p>
            </div>

            <div class="form-item">
                <p>
                    <label>ニックネーム</label>
                    <input type="text" name="nickname" value="@if(empty($user->id)){{old('nickname')}}@else{{old('nickname') ?? $user->nickname}}@endif"/>
                </p>
            </div>

            <div class="form-item">
                <p>
                    性別
                    <label for="gender1">男性</label>
                    <input type="radio" name="gender" id="gender1" value="1" @if(empty($user->id)){{old('gender') == 1 ? 'checked' : ''}}@else{{old('gender',$user->gender) == 1 ? 'checked' : ''}} @endif/>
                    <label for="gender2">女性</label>
                    <input type="radio" name="gender" id="gender2" value="2" @if(empty($user->id)){{old('gender') == 2 ? 'checked' : ''}}@else{{old('gender',$user->gender) == 2 ? 'checked' : ''}} @endif/>
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
                    <input type="text" name="email" value="@if(empty($user->id)){{old('email')}}@else{{old('email') ?? $user->email}}@endif"/>
                </p>
            </div>
            
            <input type="submit" class="ToList" value="確認画面へ"/>

        </form>
    </main>
</body>
</html>