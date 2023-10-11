<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>商品カテゴリ詳細</title>
    <link rel="stylesheet" href="{{ asset('admin_stylesheet.css') }}">
</head>
<body>
    <header>
        <div class="header_main_msg">商品カテゴリ詳細</div>
        
        <a href="{{route('categoryList')}}" class="toTop_btn">一覧へ戻る</a>
       
    </header>
    <main>
        <form action="{{route('exeDeleteCategory',['id'=>$category->id])}}" method="POST">
            @csrf
            
            <div class="form-item">
                <p>
                    商品大カテゴリID
                    {{$category->id}}
                    <input type="hidden" name="id" value="{{$category->id}}">
                </p>
            </div>

            <div class="form-item">
                <p>
                    商品大カテゴリ
                    {{$category->name}}
                </p>
            </div>

            <div class="form-item">
                <p>
                    商品小カテゴリ
                    @foreach($category->product_subcategories as $subcategory)
                        <li class="subcategory_list">{{$subcategory->name}}</li>
                    @endforeach
                </p>
            </div>
            
            <div class="btn_group">
                <a href="{{route('adminEditerCategory',['id'=>$category->id])}}" class="toEditer_btn" >編集</a>
                <input type="submit" class="delete_btn" value="削除"/>
            </div>

        </form>
    </main>
</body>
</html>