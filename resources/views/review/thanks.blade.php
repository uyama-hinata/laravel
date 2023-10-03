<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>レビュー確認画面</title>
    <link rel="stylesheet" href="{{ asset('stylesheet.css') }}">
</head>
<body>
    <header>
        <div class="header_msg list">商品レビュー登録完了</div>
        <a href="{{route('topLogin')}}">トップに戻る</a>
    </header>
    <main>
        <div class="main_msg">商品レビューの登録が完了しました。</div>
        <a href="{{route('reviewList')}}" class="toRegisterReview">商品レビュー一覧へ</a> 
        <a href="{{route('productDetail',['id'=>session('product_id')])}}" class="back_review">商品詳細に戻る</a> 
    </main>
</body>
</html>