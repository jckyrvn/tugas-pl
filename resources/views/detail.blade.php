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
        cart page

        <hr>
        <form action="/post/postcart/{{ $data->id }}" method="get">
            @csrf
            <input type="text" name="product_id" id="product_id" value="{{ $data->id }}">
            <input type="hidden" class="form-control" name="buy_id" id="buy_id"
                value="BL-{{ $buytotal }}-{{ Auth::user()->id }}-{{ $data->seller_id }}" readonly>
            <input type="text" name="seller_id" id="seller_id" value="{{ $data->seller_id }}">
            <input type="text" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
            <input type="number" name="subprice" id="subprice" value="{{ $data->price }}" onkeyup="total()">
            <input type="number" name="quantity" id="quantity" onkeyup="total()">
            <input type="text" name="price" id="price">

            <button type="submit">Add to Cart</button>
        </form>
    </section>
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>

    <script>
        function total(){
                var subprice = document.getElementById("subprice").value;
                var quantity = document.getElementById("quantity").value;
                var price = subprice*quantity;
                document.getElementById("price").value = price;
            }
    </script>
</body>

</html>