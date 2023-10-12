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
        
        <a href="{{route('registerCategory')}}" class="toTop_btn">商品カテゴリ登録</a>
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
                        @if ($sortOrder == 'asc' && $sortField == 'id')
                            <a href="{{ route('categoryList', array_merge(request()->query(), ['order' => 'desc', 'field' => 'id'])) }}">▲</a>
                        @else
                            <a href="{{ route('categoryList', array_merge(request()->query(), ['order' => 'asc', 'field' => 'id'])) }}">▼</a>
                        @endif
                    </th>
                    <th>商品大カテゴリ</th>
                    <th>登録日時
                        @if ($sortOrder == 'asc' && $sortField == 'created_at')
                            <a href="{{ route('categoryList', array_merge(request()->query(), ['order' => 'desc', 'field' => 'created_at'])) }}">▲</a>
                        @else
                            <a href="{{ route('categoryList', array_merge(request()->query(), ['order' => 'asc', 'field' => 'created_at'])) }}">▼</a>
                        @endif
                    </th>
                    <th>編集</th>
                    <th>詳細</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                    <tr>
                        <th>{{$category->id}}</th>
                        <th><a href="{{route('adminDetailCategory',['id'=> $category->id])}}">{{$category->name}}</a></th>
                        <th>{{date_format($category->created_at,'Y/m/d')}}</th>
                        <th><a href="{{route('adminEditerCategory',['id'=>$category->id])}}">編集</a></th>
                        <th><a href="{{route('adminDetailCategory',['id'=> $category->id])}}">詳細</a></th>
                    </tr>
                @endforeach
            </tbody>
        </div>

        <div class="page">{{$categories->appends(request()->query())->links('vendor.pagination.bootstrap-5')}}</div>
    </main>
</body>
</html>