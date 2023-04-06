<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    <link href="css/main.css" rel="stylesheet"/>
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
          <div class="event-container">
            <img src="{{ asset('images/event1.png') }}" />
          </div>
          <div class="text-featured">
            <label>Featured</label>
            <div class="dropdown">
                <div class="filter"  data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-funnel-fill"></i>
                    <p>Filter</p>
                </div>
                    <ul class="dropdown-menu">
                        <li>
                            tes
                        </li>
                    </ul>
            </div>
          </div>



          <div class="main-content">
              @foreach($product as $loop_product)
              <form action="/post/detail/{{ $loop_product->id }}" class="" method="get">
                @csrf
                <button type="submit" class="wrap-content">
                  <img src="/productimg/{{ $loop_product->media }}" />
                    <div class="text-content">
                        <p>{{ $loop_product->name_product }}</p>
                        <div class="discount-label">
                            <label>Discount {{ $loop_product->discount }}%</label>
                            <span>Free Delivery</span>
                        </div>
                        <div class="price-content">
                            <p>Rp. {{ $loop_product->subprice }},00</p>
                            <h1>Rp. {{ $loop_product->price }},00</h1>
                        </div>
                    </div>
                </button>
                </form>

                @endforeach
            </div>    

          

        <!-- @if (\Auth::user() && \Auth::user()->isAdmin == true)
        <a class="dropdown-item text-dark" href="/admin/home">
            Admin Page
        </a>
        @endif

        @if (\Auth::user() && \Auth::user()->isSeller == false)
        <a href="/post/seller">become seller</a>
        @endif -->


    </section>
    
    

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
        
</body>

</html>