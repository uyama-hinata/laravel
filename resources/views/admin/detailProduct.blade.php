<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>商品詳細</title>
    <link rel="stylesheet" href="{{ asset('admin_stylesheet.css') }}">
</head>
<body>
    <header>
        <div class="header_main_msg">商品詳細</div>
        
        <a href="{{route('adminProductList')}}" class="toTop_btn">一覧へ戻る</a>
       
    </header>
    <main>
        <form action="{{route('exeDeleteProduct',['id'=>$product->id])}}" method="POST">
            @csrf
            
            <div class="form-item">
                <p>
                    商品ID
                    {{$product->id}}
                    <input type="hidden" name="id" value="{{$product->id}}">
                </p>
            </div>

            <div class="form-item">
                <p>
                    会員
                    @if($product->user){{$product->user->name_sei}}{{$product->user->name_mei}}@else退会済み@endif
                    <input type="hidden" name="id" value=" @if($product->users){{$product->users->name_sei}}{{$product->users->name_mei}}@endif">
                </p>
            </div>

            <div class="form-item">
                <p>
                    商品名
                    {{$product->name}}
                </p>
            </div>

            <div class="form-item">
                <p>
                    商品カテゴリ
                    @if($product->product_category){{$product->product_category->name}}＞{{$product->product_subcategory->name}}@endif
                </p>
            </div>

            <div class="form-item">
                <p>
                    商品写真
                    <div class="detail-image">
                        写真１
                        @if($product->image_1)<img src="{{asset('storage/' . $product->image_1)}}">@endif <br>
                    </div>
                    <div class="detail-image">
                        写真２
                        @if($product->image_2)<img src="{{asset('storage/' . $product->image_2)}}">@endif <br> 
                    </div>
                    <div class="detail-image">
                        写真３
                        @if($product->image_3)<img src="{{asset('storage/' . $product->image_3)}}">@endif <br>
                    </div>
                    <div class="detail-image">
                        写真４
                        @if($product->image_4)<img src="{{asset('storage/' . $product->image_4)}}">@endif <br>
                    </div>
                </p>
            </div>

            <div class="form-item">
                <p>
                    商品説明
                    {{$product->product_content}}
                </p>
            </div>

            <div class="form-itemReview">
                <p>
                    総合評価　@for ($i=0;$i<$averageEvaluation;$i++)★ @endfor
                    {{$averageEvaluation ? $averageEvaluation : '未評価'}}
                </p>
            </div>

            <div class="form-item">
                @if($reviews->isEmpty())
                    <div class="center">まだ評価されていません</div>
                @else
                    @foreach($reviews as $review)
                        <div class="detail-reviewId">
                            <p>
                                商品レビューID
                                {{$review->id}}
                            </p>
                        </div>
                        <div class="detail-reviewUser">
                            <p>
                                @if($product->user)
                                    <a href="{{route('adminDetailUser',['id'=>$product->user->id])}}">{{$review->user->nickname}}さん</a>
                                @else
                                    退会済みユーザー 
                                @endif　
                                @for ($i=0;$i<$review->evaluation;$i++)★ @endfor　{{$review->evaluation}}
                            </p>
                        </div>
                        <div class="detail-reviewComment">
                            {{$review->comment}}
                            <a href="" class="toReview_link">商品レビュー詳細</a>
                        </div>
                        
                    @endforeach
                @endif
            </div>
            <div class="page">{{$reviews->appends(request()->query())->links('vendor.pagination.bootstrap-5')}}</div>


            <div class="btn_group">
                <a href="{{route('adminEditerProduct',['id'=>$product->id])}}" class="toEditer_btn" >編集</a>
                <input type="submit" class="delete_btn" value="削除"/>
            </div>

        </form>
    </main>
</body>
</html>