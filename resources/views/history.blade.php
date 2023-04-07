<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link href="/css/main.css" rel="stylesheet" />

</head>

<body>
    @if(session()->has('success'))
    <div class="alert alert-success ">
        {{ session('success') }}
    </div>
    @endif

    @if(session()->has('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    @include('layouts.navbar')
    <section>
        History page <br><br>

        {{ $dataall2->id }} <br>
        {{ $dataall2->status }} <br> <br>



        @foreach ($dataall as $item)
        <input type="text" name="buy_id" id="buy_id" value="{{ $item->buy_id }}" readonly>
        <input type="text" name="id" id="id" value="{{ $item->id }}">
        <input type="text" name="product_id" id="product_id" value="{{ $item->product_id }}">
        <input type="text" name="user_id" id="user_id" value="{{ $item->user_id }}">
        <input type="text" name="seller_id" id="seller_id" value="{{ $item->seller_id }}">
        <input type="number" name="subprice" id="subprice" value="{{ $item->subprice }}">
        <input type="number" name="quantity" id="quantity" value="{{ $item->quantity }}">
        <input type="text" name="price" id="price" value="{{ $item->price }}">
        <img src="/productimg/{{ $item->productdetail->media }}" alt="">
        @endforeach

        Name Of Recipent = {{ $user->name }} <br>
        Address = {{ $user->address }} <br>
        Number = {{ $user->number }} <br>

        @foreach ($dataall as $item)
        @csrf
        <hr>
        <input type="text" name="product_name" id="product_name" value="{{ $item->productdetail->name_product }}">
        <input type="text" name="product_id" id="product_id" value="{{ $item->product_id }}">
        <input type="text" name="seller_id" id="seller_id" value="{{ $item->seller_id }}">
        <input type="number" name="subprice" id="subprice" value="{{ $item->subprice }}">
        <input type="number" name="quantity" id="quantity" value="{{ $item->quantity }}">
        <input type="text" name="price" id="price" value="{{ $item->price }}">

        @endforeach
        </form>

        <hr>

        <form action="/pdf/home/{{ $dataall2->id }}" method="get">
            <button type="submit">Download PDF</button>
        </form>

        <form action="/post/updatehistory/{{ $dataall2->id }}" method="post">
            @csrf
            <button type="submit">Order Received</button>
        </form>

    </section>
</body>

</html>