<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $data->name_product }}</title>

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
            <label>Detail Product</label>
        </div>

        <div class="container-detail">
            <img src="/productimg/{{ $data->media }}" class="img-thumbnail" />
            <div class="main-detail">
                <div class="main-text">
                    <label>{{ $data->name_product }}</label>
                    <p>{{ $data->description }}</p>
                </div>
                <div class="discount-label">
                    <label>Discount {{ $data->discount }}%</label>
                    <span>Free Delivery</span>
                </div>

                <div class="price-content">
                    <p>Rp. {{ $data->subprice }},00</p>
                    <form action="/post/postcart/{{ $data->id }}" method="get">
                        @csrf
                        <input type="hidden" name="product_id" id="product_id" value="{{ $data->id }}">
                        <input type="hidden" class="form-control" name="buy_id" id="buy_id"
                            value="BL-{{ $buytotal }}-{{ Auth::user()->id }}-{{ $data->seller_id }}" readonly>
                        <input type="hidden" name="seller_id" id="seller_id" value="{{ $data->seller_id }}">
                        <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
                        <label>Rp.</label> <input type="number" name="subprice" id="subprice" value="{{ $data->price }}"
                            onkeyup="total()" readonly>


                        <div class="wrap-quantity">
                            Quantity :
                            <span class="down" onClick='decreaseCount(event, this)'>-</span>
                            <input type="number" name="quantity" id="quantity" min="1" value="1" onkeyup="total()">
                            <span class="up" onClick='increaseCount(event, this)'>+</span>
                        </div>


                        <div class="wrap-finish">
                            Total:
                            <div class="wrap-price">
                                <label>Rp.</label> <input type="text" name="price" id="price" value="{{ $data->price }}"
                                    readonly>
                            </div>
                            <button type="submit">Add to Cart</button>
                        </div>
                        <!-- <button type="submit" formaction="/post/post"> -->
                    </form>
                </div>
            </div>

        </div>



    </section>
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>

    <script>
        function total(){
                var subprice = document.getElementById("subprice").value;
                var quantity = document.getElementById("quantity").value;
                var price = subprice*quantity;
                document.getElementById("price").value = price;
            }
            
            function increaseCount(a, b) {
                var subprice = document.getElementById("subprice").value;
                var input = b.previousElementSibling;
                var value = parseInt(input.value);
                value = isNaN(value)? 0 : value;
                value ++;
                var price = Number(value)* Number(subprice);
                input.value = value;
                document.getElementById("price").value = price;
            }
            function decreaseCount(a, b) {
                var subprice = document.getElementById("subprice").value;
                var input = b.nextElementSibling;
                var value = parseInt(input.value);
                value = isNaN(value)? 0 : value;
                if(value <= 1){
                    input.value = 1;
                }else{   
                    value --;
                }
                var price = Number(value)* Number(subprice);
                input.value = value;
                document.getElementById("price").value = price;
            }
    </script>
</body>

</html>