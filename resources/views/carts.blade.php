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
        

    <div class="back-profile">
            <a href="{{ route('home') }}">
                <i class="bi bi-chevron-left"></i>
            </a>
        <label>Carts</label>
    </div>

    <div class="main-carts">
        @foreach ($data as $item)
        <form action="/post/cart/{{ $item->buy_id }}" method="get" >
            
                <img src="/images/profile.png" />

                <div class="wrap-content">
                    <div class="self-content">
                        No Order : <input type="text" class="no-order" name="buy_id" id="buy_id" value="{{ $item->buy_id }}" readonly>
                    </div>

                    <div class="two-content">
                        <label>Total</label>
                         Rp. {{ $item->price }},00
                         <input type="hidden" name="price" id="price" value="{{ $item->price }}" readonly>
                    </div>
                    <button type="submit">Detail</button>
                </div>
                 

                <input type="hidden" name="id" id="id" value="{{ $item->id }}">
                <input type="hidden" name="product_id" id="product_id" value="{{ $item->product_id }}">
                <input type="hidden" name="user_id" id="user_id" value="{{ $item->user_id }}">
                <input type="hidden" name="seller_id" id="seller_id" value="{{ $item->seller_id }}">
                <input type="hidden" name="subprice" id="subprice" value="{{ $item->subprice }}">
                <input type="hidden" name="quantity" id="quantity" value="{{ $item->quantity }}">


        </form>
            @endforeach
    </div>

    </section>
</body>

</html>