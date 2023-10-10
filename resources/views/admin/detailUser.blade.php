<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>会員情報詳細</title>
    <link rel="stylesheet" href="{{ asset('admin_stylesheet.css') }}">
</head>
<body>
    <header>
        <div class="header_main_msg">会員詳細</div>
        
        <a href="{{route('userList')}}" class="toTop_btn">一覧へ戻る</a>
       
    </header>
    <main>
        <form action="{{route('exeDeleteUser',['id'=>$user->id])}}" method="POST">
            @csrf
            
            <div class="form-item">
                <p>
                    ID
                    {{$user->id}}
                    <input type="hidden" name="id" value="{{$user->id}}">
                </p>
            </div>

            <div class="form-item">
                <p>
                    氏名
                    {{$user->name_sei}}{{$user->name_mei}}
                </p>
            </div>

            <div class="form-item">
                <p>
                    ニックネーム
                    {{$user->nickname}}
                </p>
            </div>

            <div class="form-item">
                <p>
                    性別
                    @if(($user->gender) == 1)
                    男性
                    @elseif(($user->gender) == 2)
                    女性
                    @endif
                </p>
            </div>

            <div class="form-item">
                <p>
                    パスワード
                    セキュリティのため非表示
                </p>
            </div>

            <div class="form-item">
                <p>
                    メールアドレス
                    {{$user->email}}
                </p>
            </div>
            
            <div class="btn_group">
                <a href="{{route('adminEditerUser',['id'=>$user->id])}}" class="toEditer_btn" >編集</a>
                <input type="submit" class="delete_btn" value="削除"/>
            </div>

        </form>
    </main>
</body>
</html>