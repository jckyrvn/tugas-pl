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

    <div class="main-profile">

        <div class="back-profile">
                <a href="{{ url('pages/seller') }}/{{ Auth::user()->id }}">
                    <i class="bi bi-chevron-left"></i>
                </a>
                <label>Orders</label>
            </div>

        @foreach ($dataall as $item)
        <form action="/seller/orders/{{ $item->id }}" class="second-content" method="get">
            <input type="hidden" name="status" id="status" value="{{ $item->id }}">
            <input type="hidden" name="status" id="status" value="{{ $item->status }}">

                        <div class="wrap-history">
                            <label>No. Order : {{ $item->id }}</label> 
                            <p>Status : {{ $item->status }} </p>
                             

                            <span>Order Date : <p>{{ date('d-m-y', strtotime( $item->created_at )) }}</p> </span>
                            <span>Total : <p>Rp. {{ $item->totalprice }},00</p> </span>
                             
                        </div>

            <button type="submit">Edit Orders</button>
        </form>
        @endforeach


    </div>

</body>

</html>