<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>一覧画面</title>
    <link rel="stylesheet" href="{{ asset('stylesheet.css') }}">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <div class="header_msg list">商品一覧</div>
        @auth
        <a href="{{route('productRegister')}}" name="toRegist_btn">新規商品登録</a>
        @endauth
    </header>
    <main>
        <div class="search_box">
            <form action="" method="get">
                @csrf
                <span>カテゴリ</span>
                    <select name="searvh_category" id="product_category_id">
                        <option value=""></option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}" @if(old('product_category_id')==$category->id) selected @endif>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <select name="searvh__subcategory" id="product_subcategory_id">
                        @if(!empty(old('product_subcategory_id')))
                            @foreach($subcategories as $subcategory)
                                @if($subcategory->product_category_id = old('product_category_id'))
                                    <option value="{{$subcategory->id}}"{{(old('product_subcategory_id') == $subcategory->id) ? "selected" : ""}}>{{ $subcategory->name }}</option>
                                @endif
                            @endforeach 
                        @endif
                    </select>
                <span>フリーワード</span>
                    <input type="text" name="search_freeword" value="">
                <input type="submit" name="search_btn" class="search_btn" value="商品検索">
            </form>

            <div class="show">
                @foreach($products as $product)
                    <img src="" alt="">

                @endforeach
            </div>
        </div>
        
    </main>
    <script>
        $(function(){
            // カテゴリを選択すると呼び出される関数
            $('#product_category_id').change(function(){
                var key=$('#product_category_id option:selected').val();
                console.log(key);

                // 選択されたカテゴリに基づいてサブを取得
                $.get(`/product-register/${key}`,function(data){
                    // サブカテゴリをクリア
                    var subcategorySelect=$('#product_subcategory_id');
                    subcategorySelect.empty();

                    // 新しいオプションを追加
                    data.forEach(function(subcategory){
                        subcategorySelect.append(`<option value="${subcategory.id}">${subcategory.name}</option>`);
                    });

                });
            });
        });
    </script>
</body>
</html>