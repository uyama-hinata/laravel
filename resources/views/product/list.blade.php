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
            <form action="{{route('productList')}}" method="get">
                @csrf
                <span>カテゴリ</span>
                    <select name="search_category" id="product_category_id">
                        <option value=""></option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}" {{request('search_category')==$category->id ?  'selected' : ''}}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <select name="search_subcategory" id="product_subcategory_id">
                        <option value=""></option>
                            @foreach($subcategories as $subcategory)
                                @if(!request('search_category') || $subcategory->product_category_id == request('search_category'))
                                    <option value="{{$subcategory->id}}"{{request('search_subcategory')==$subcategory->id ?  'selected' : ''}}>{{ $subcategory->name }}</option>
                                @endif
                            @endforeach 
                    </select>
                <span>フリーワード</span>
                    <input type="text" name="search_freeword" value="{{request('search_freeword')}}">
                <input type="submit" name="search_btn" class="search_btn" value="商品検索">
            </form>
        </div>
        <div class="show">
            @foreach($products as $product)
                <div class="show-item">
                    <div class="show-images">
                        @if(!empty($product->image_1))
                            <img class="show_image" src="{{asset('storage/' . $product->image_1)}}">
                        @endif
                        @if(!empty($product->image_2))
                            <img class="show_image" src="{{asset('storage/' . $product->image_2)}}">
                        @endif
                        @if(!empty($product->image_3))
                            <img class="show_image" src="{{asset('storage/' . $product->image_3)}}">
                        @endif
                        @if(!empty($product->image_4))
                            <img class="show_image" src="{{asset('storage/' . $product->image_4)}}">
                        @endif
                    </div>
                    <div class="show-info">
                        <div class="show-categories">
                            <div class="show_category">{{$product->product_category->name}}</div>＞
                            <div class="show_subcategory">{{$product->product_subcategory->name}}</div>
                        </div>
                        <div class="show_name"><a class="show_name" href="product-detail/{{$product->id}}">{{$product->name}}</a></div>
                        <div class="show_review">
                            @if(empty($product->averageEvaluation->evaluations))
                            @elseif($product->averageEvaluation->evaluations==1)★
                            @elseif($product->averageEvaluation->evaluations==2)★★
                            @elseif($product->averageEvaluation->evaluations==3)★★★
                            @elseif($product->averageEvaluation->evaluations==4)★★★★
                            @elseif($product->averageEvaluation->evaluations==5)★★★★★
                            @endif
                            {{$product->averageEvaluation->evaluations ?? '未評価'}}
                        </div>
                        <div><a class="detail_btn" href="product-detail/{{$product->id}}">詳細</a></div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="page">{{$products->appends(request()->query())->links('vendor.pagination.bootstrap-5')}}</div>

        @auth
            <a href="{{route('topLogin')}}" name="toLogin_btn" class="toTop">トップに戻る</a>
        @endauth
        @guest
            <a href="{{route('topLogout')}}" name="toLogout_btn" class="toTop">トップに戻る</a>
        @endguest
        
    </main>
    <script>
        $(function(){
            // サブカテゴリをロードする関数
            function loadSubcategories(categoryId,callback){
                $.get(`/product-register/${categoryId}`,function(data){
                    // サブカテゴリをクリア
                    var subcategorySelect=$('#product_subcategory_id');
                    subcategorySelect.empty();

                    // 空白の選択肢を追加
                    subcategorySelect.append('<option value=""></option>');

                    // 新しいオプションを追加
                    data.forEach(function(subcategory){
                        var selected='{{old("search_subcategory")}}' == subcategory.id ? 'selected' : '';
                        subcategorySelect.append(`<option value="${subcategory.id}" ${selected}>${subcategory.name}</option>`);
                    });

                    if(callback){callback();}
                });
            }
            
            // カテゴリが変更された時にサブカテゴリをロード
            $(`#product_category_id`).change(function(){
                var categoryId=$(this).val();
                loadSubcategories(categoryId);
            });

        });
    </script>
</body>
</html>