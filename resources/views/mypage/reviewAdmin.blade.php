<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>商品レビュー管理</title>
    <link rel="stylesheet" href="{{ asset('stylesheet.css') }}">
</head>
<body>
    <header>
        <div class="header_msg list">商品レビュー管理</div>
        
        <a href="{{route('topLogin')}}">トップに戻る</a>
        
    </header>
    <main>
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

        <div class="page">{{$reviews->links('vendor.pagination.bootstrap-5')}}</div>

        <a href="{{route('mypage')}}" class="back_review">マイページに戻る</a>
        
    </main>
</body>
</html>