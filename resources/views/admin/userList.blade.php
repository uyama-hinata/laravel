<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>会員一覧</title>
    <link rel="stylesheet" href="{{ asset('admin_stylesheet.css') }}">
</head>
<body>
    <header>
        <div class="header_main_msg">会員一覧</div>
        
        <a href="{{route('adminRegisterUser')}}" class="toTop_btn">会員登録</a>
        <a href="{{route('adminTop')}}" class="toTop_btn">トップへ戻る</a>
       
    </header>
    <main>
        <div class="search_box">
            <form action="{{route('userList')}}" method="get">
                @csrf
                <div class="search_item">
                    <span>ID</span>
                    <input type="text" name="search_id" value="{{session('search_id')}}">
                </div>
                <div class="search_item">
                    <span>性別</span>
                    <input type="checkbox"  name="search_gender[]"  value="1" {{in_array(1,(array)session('search_gender')) == 1 ? 'checked' : ''}} >男性
                    <input type="checkbox"  name="search_gender[]"  value="2" {{in_array(2,(array)session('search_gender')) == 2 ? 'checked' : ''}} >女性
                </div>   
                <div class="search_item">   
                <span>フリーワード</span>
                    <input type="text" name="search_freeword" value="{{session('search_freeword')}}">
                <input type="submit" name="search_btn" class="search_btn" value="検索する">
                </div>
            </form>
        </div>

        <table class="show">
            <thead>
                <tr>
                    <th>ID
                        @if($sortOrder=='asc' && $sortField =='id')
                            <a href="{{route('userList',array_merge(request()->query(),['order'=>'desc','field'=>'id'])) }}">▲</a>
                        @else
                            <a href="{{route('userList',array_merge(request()->query(),['order'=>'asc','field'=>'id'])) }}">▼</a>
                        @endif
                    </th>
                    <th>氏名</th>
                    <th>メールアドレス</th>
                    <th>性別</th>
                    <th>登録日時
                        @if($sortOrder=='asc' && $sortField =='created_at')
                            <a href="{{route('userList',array_merge(request()->query(),['order'=>'desc','field'=>'created_at']))}}">▲</a>
                        @else
                            <a href="{{route('userList',array_merge(request()->query(),['order'=>'asc','field'=>'created_at']))}}">▼</a>
                        @endif
                    </th>
                    <th>編集</th>
                    <th>詳細</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <th>{{$user->id}}</th>
                        <th><a href="{{route('adminDetailUser',['id'=> $user->id])}}">{{$user->name_sei}}{{$user->name_mei}}</a></th>
                        <th>{{$user->email}}</th>
                        <th>@if($user->gender==1)男性@elseif($user->gender==2)女性@endif</th>
                        <th>{{date_format($user->created_at,'Y/m/d')}}</th>
                        <th><a href="{{route('adminEditerUser',['id'=> $user->id])}}">編集</a></th>
                        <th><a href="{{route('adminDetailUser',['id'=> $user->id])}}">詳細</a></th>
                    </tr>
                @endforeach
            </tbody>
        </div>

        <div class="page">{{$users->appends(request()->query())->links('vendor.pagination.bootstrap-5')}}</div>
    </main>
</body>
</html>