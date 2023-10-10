<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>カテゴリ一覧</title>
    <link rel="stylesheet" href="{{ asset('admin_stylesheet.css') }}">
</head>
<body>
    <header>
        <div class="header_main_msg">カテゴリ一覧</div>
        
        <a href="{{route('adminTop')}}" class="toTop_btn">トップへ戻る</a>
       
    </header>
    <main>
        <div class="search_box">
            <form action="{{route('categoryList')}}" method="get">
                @csrf
                <div class="search_item">
                    <span>ID</span>
                    <input type="text" name="search_id" value="{{session('search_id')}}">
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
                        @if($order=='asc')
                            <a href="{{route('categoryList',array_merge(request()->query(),['order'=>'desc'])) }}">▲</a>
                        @else
                            <a href="{{route('categoryList',array_merge(request()->query(),['order'=>'asc'])) }}">▼</a>
                        @endif
                    </th>
                    <th>商品大カテゴリ</th>
                    <th>登録日時
                        @if($dateorder=='asc')
                            <a href="{{route('categoryList',array_merge(request()->query(),['dateorder'=>'desc']))}}">▲</a>
                        @else
                            <a href="{{route('categoryList',array_merge(request()->query(),['dateorder'=>'asc']))}}">▼</a>
                        @endif
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                    <tr>
                        <th>{{$category->id}}</th>
                        <th>{{$category->name}}</th>
                        <th>{{date_format($category->created_at,'Y/m/d')}}</th>
                    </tr>
                @endforeach
            </tbody>
        </div>

        <div class="page">{{$categories->appends(request()->query())->links('vendor.pagination.bootstrap-5')}}</div>
    </main>
</body>
</html>