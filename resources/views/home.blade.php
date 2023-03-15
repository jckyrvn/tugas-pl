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
    <link href="css/main.css" rel="stylesheet" />

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
        @if (\Auth::user() && \Auth::user()->isSeller == true)
        <a class="dropdown-item text-dark" href="/seller/home">
            Seller Page
        </a>
        @endif

        @if (\Auth::user() && \Auth::user()->isAdmin == true)
        <a class="dropdown-item text-dark" href="/admin/home">
            Admin Page
        </a>
        @endif

        @if (\Auth::user() && \Auth::user()->isSeller == false)
        <a href="/post/seller">become seller</a>
        @endif


        {{ Auth::user()->id }}
    </section>
</body>

</html>