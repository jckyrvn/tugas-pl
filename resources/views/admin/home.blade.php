<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet" />

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

            <div class="back-profile" hidden>

            </div>

            <div class="content" hidden>
                <div class="wrap-content">

                </div>

                <div class="button-content">


                </div>

            </div>

            <div class="history-profile">
                <label>Admin Page</label>
            </div>



            @foreach( $data as $item )
            <div class="second-content">

                <div class="flex-product">
                    <div class="wrap-product">
                        <h1>Name : {{ $item -> user -> name }}</h1>
                        <label>Merchant Address :{{ $item -> merchant_address }}</label>
                        <span>User ID : {{ $item -> seller_id }}</span>
                        <span>User Email : {{ $item -> user -> email }}</span>
                    </div>
                </div>


                <div class="wrap-button">

                    <form method="get" action="/admin/approve/{{ $item -> seller_id }}">
                        <button type="submit" class="button-1">Approve</button>
                    </form>

                    <form method="get" action="/admin/reject/{{ $item -> seller_id }}">
                        <button type="submit" class="button-2">Reject</button>
                    </form>

                </div>

            </div>
            @endforeach
    </section>
</body>

</html>