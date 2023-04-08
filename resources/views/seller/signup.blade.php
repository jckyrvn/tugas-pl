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
    <link href="../css/main.css" rel="stylesheet" />

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


    <section class="container-background">
        <div class="container-mid">
            <img src="{{ asset('images/logo.png') }}" class="img-logo">
            <form action="/post/signupseller/{{ Auth::user()->id }}" method="post" class="form-auth">
                @csrf
                <label>Become Seller</label>
                @if ($errors->any())
                    <div class="error">
                    @foreach ($errors->all() as $message)
                        <p>{{ $message }}</p>
                    @endforeach
                    </div>
                @endif
                <span>Seller ID</span>
                <input type="text" name="seller_id" id="seller_id" value="{{ Auth::user()->id }}" readonly> <br>
                <span>Merchant Address</span>
                <input name="merchant_address" id="merchant_address" />
                <button type="submit">Submit</button>
            </form>
        </div>
    </section>
</body>

</html>