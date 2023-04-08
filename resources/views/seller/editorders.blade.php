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
    <div class="wrap-back">
            <div class="back-profile">
                <a href="{{ url('seller/orders') }}">
                    <i class="bi bi-chevron-left"></i>
                </a>
                <label>Orders</label>
             </div>
            <div class="data-all">
                <label>No Order : {{ $dataall2->id }}</label> 
                <span>Status : {{ $dataall2->status }}</span>
             </div>
        </div>


        <div class="main-checkout">

            <div class="wrap-left">
                @foreach ($dataall as $item)
                <div class="second-left">
                    <img src="/productimg/{{ $item->productdetail->media }}" alt="">
                    <div class="wrap-product">
                        <label>{{ $item->productdetail->name_product }}</label>
                        <p>Quantity: {{ $item->quantity }}pcs</p>
                        <h1>Rp. {{ $item->subprice }},00</h1>
                    </div>
                    <input type="hidden" name="buy_id" id="buy_id" value="{{ $item->buy_id }}" readonly>
                    <input type="hidden" name="id" id="id" value="{{ $item->id }}">
                    <input type="hidden" name="product_id" id="product_id" value="{{ $item->product_id }}">
                    <input type="hidden" name="user_id" id="user_id" value="{{ $item->user_id }}">
                    <input type="hidden" name="seller_id" id="seller_id" value="{{ $item->seller_id }}">
                    <input type="hidden" name="subprice" id="subprice" value="{{ $item->subprice }}">
                    <input type="hidden" name="quantity" id="quantity" value="{{ $item->quantity }}">
                    <input type="hidden" name="price" id="price" value="{{ $item->price }}">
                </div>
                @endforeach
            </div>

            <div class="wrap-right">

                <div class="content-detail">
                    <h1>Contact Details</h1>
                    <label>Name Of Recipent</label>
                    <input type="text" value="{{ $user->name }}" readonly />

                    <label> Phone Number </label>
                    @if( Auth::user()->number != null)
                    <input type="text" value="{{ $user->number }}" readonly />
                    @else
                    <input type="text" placeholder="You Must Add Number!" readonly />
                    @endif

                    <label> Address </label>
                    @if( Auth::user()->address != null)
                    <input type="text" value="{{ $user->address }}" readonly />
                    @else
                    <input type="text" placeholder="You Must Add Address!" readonly />
                    @endif
                </div>



                <div class="wrap-total">
                    <h1>Total</h1>
                    @foreach ($dataall as $item)

                    <div class="total-left">
                        <label>{{ $item->productdetail->name_product }}</label>
                        <span>{{ $item->quantity }} * {{ $item->subprice }} = <p> Rp. {{ $item->price }},00</p></span>
                    </div>

                    @endforeach
                    <div class="total-right">
                        <span>Subtotal<p>Rp. {{ $sum1 }},00</p></span>
                        <span>Biaya Layanan<p>FREE</p></span>
                        <span>Biaya Ongkir<p>FREE</p></span>
                        <span>Total<p>Rp. {{ $sum1 }},00</p></span>
                    </div>
                </div>


                <input type="hidden" name="product_name" id="product_name"
                    value="{{ $item->productdetail->name_product }}">
                <input type="hidden" name="product_id" id="product_id" value="{{ $item->product_id }}">
                <input type="hidden" name="user_id" id="user_id" value="{{ $item->user_id }}">
                <input type="hidden" name="seller_id" id="seller_id" value="{{ $item->seller_id }}">
                <input type="hidden" name="subprice" id="subprice" value="{{ $item->subprice }}">
                <input type="hidden" name="quantity" id="quantity" value="{{ $item->quantity }}">
                <input type="hidden" name="price" id="price" value="{{ $item->price }}">
                <input type="hidden" name="totalprice" id="totalprice" value="">

        <form action="/seller/updateorders/{{ $dataall2->id }}" method="post">
            @csrf
            <button type="submit">Ship</button>
        </form>

    </section>
</body>

</html>