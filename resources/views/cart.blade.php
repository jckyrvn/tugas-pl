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
            <a href="{{ route('carts') }}">
                <i class="bi bi-chevron-left"></i>
            </a>
            <label>Cart</label>
        </div>



        <div class="main-carts">
            @foreach ($data as $item)
            <form action="/post/destroycart/{{ $item->id }}" method="get">
                <img src="/productimg/{{ $item->product->media }}" alt="">
                <div class="wrap-content">
                    <div class="self-content">
                        {{ $item->product->name_product }}
                    </div>

                    <div class="two-content">
                        Rp. {{ $item->price }},00
                        <input type="hidden" name="price" id="price" value="{{ $item->price }}" readonly>
                        <div class="three-content">
                            Quantity: {{ $item->quantity }}
                        </div>
                    </div>
                    <button type="submit" class="destroy-carts">Delete</button>
                </div>
                
            <input type="hidden" name="buy_id" id="buy_id" value="{{ $item->buy_id }}" readonly>
            <input type="hidden" name="id" id="id" value="{{ $item->id }}">
            <input type="hidden" name="product_id" id="product_id" value="{{ $item->product_id }}">
            <input type="hidden" name="user_id" id="user_id" value="{{ $item->user_id }}">
            <input type="hidden" name="seller_id" id="seller_id" value="{{ $item->seller_id }}">
            <input type="hidden" name="subprice" id="subprice" value="{{ $item->subprice }}">
            <input type="hidden" name="quantity" id="quantity" value="{{ $item->quantity }}">
            <input type="hidden" name="price" id="price" value="{{ $item->price }}">

            </form>
            @endforeach
        </div>
        <form action="/buy/checkout/{{ $item->buy_id }}" class="form-carts" method="get">
            @csrf
            <input type="hidden" name="buy_id" id="buy_id" value="{{ $item->buy_id }}" readonly>
            <input type="hidden" name="id" id="id" value="{{ $item->id }}">
            <input type="hidden" name="product_id" id="product_id" value="{{ $item->product_id }}">
            <input type="hidden" name="user_id" id="user_id" value="{{ $item->user_id }}">
            <input type="hidden" name="seller_id" id="seller_id" value="{{ $item->seller_id }}">
            <input type="hidden" name="subprice" id="subprice" value="{{ $item->subprice }}">
            <input type="hidden" name="quantity" id="quantity" value="{{ $item->quantity }}">
            <input type="hidden" name="price" id="price" value="{{ $item->price }}">
            <input type="hidden" name="totalprice" id="totalprice" value="{{ $sum1 }}">
            <button class="button-1" type="submit">Checkout</button>
        </form>
        
    </section>
</body>

</html>