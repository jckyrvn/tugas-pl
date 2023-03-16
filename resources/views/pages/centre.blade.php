<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centre Page</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link href="css/main.css" rel="stylesheet"/>

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
                <a href="{{ route('profile') }}">
                <i class="bi bi-chevron-left"></i>
                </a>
                <label>Seller</label>
            </div>

            <div class="content">
                <div class="wrap-content">
                    <img src="{{ asset('images/profile.png') }}">
                    <div class="user">
                        <label>{{ Auth::user()->name }}</label>
                        <p>{{ Auth::user()->email }}</p>
                        <p>0812345678910</p>
                    </div>
                </div>
            </div>
            
            <hr>
            
            <div class="second-profile">
                <div class="history-profile">
                    <label>Product</label>
                </div>
                <a href="/seller/home">
                    New
                </a>
                
                
            </div>
                <div class="second-content">
                    <div></div>
                </div>
            
          </div>
    </section>
    
    

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
</body>
</html>