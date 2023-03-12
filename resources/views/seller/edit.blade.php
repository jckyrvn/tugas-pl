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
        <b>master data product</b>

        <form action="/seller/updateproduct/{{ $data->id }}" method="post" enctype="multipart/form-data">
            @csrf

            <input type="text" name="name_product" id="name_product" placeholder="name_product"
                value="{{ $data->name_product }}"> <br>
            <textarea name="description" id="description" placeholder="description"
                value="{{ $data->description }}">{{ $data->description }}</textarea> <br>
            <input type="number" name="price" id="price" placeholder="price" value="{{ $data->price }}"> <br>
            <input type="text" name="seller_id" id="seller_id" placeholder="seller_id" value="{{ $data->seller_id }}"
                readonly>
            <br>
            <input type="file" name="media" id="media"> <br>
            <input type="number" name="stock" id="stock" placeholder="stock" value="{{ $data->stock }}"> <br>

            <br>
            <button type="submit">Update</button>
        </form>
    </section>
</body>

</html>