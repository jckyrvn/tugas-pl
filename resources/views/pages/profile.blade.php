<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>

    <link href="{{ asset('css/main.css') }}" rel="stylesheet" />

</head>

<body>
    @include('layouts.navbar')
    <section>
        <div class="main-profile">

            <div class="back-profile">
                <a href="{{ route('home') }}">
                    <i class="bi bi-chevron-left"></i>
                </a>
                <label>Profile</label>
            </div>

            <div class="content">
                <div class="wrap-content">
                    @if(Auth::user()->profile == null)
                    <span>{{ substr( Auth::user()->name,  0 ,1) }}</span>
                    @else
                    <img src="/profileimg/{{ Auth::user()->profile }}">
                    @endif
                    <div class="user">
                        <label>{{ Auth::user()->name }}</label>
                        <p>{{ Auth::user()->email }}</p>
                        <p>{{ Auth::user()->number }}</p>
                    </div>
                </div>

                <div class="button-content">
                    <form action="{{ url('pages/seller') }}/{{ Auth::user()->id }}" method="GET">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <!-- <a class="dropdown-item" href="{{ url('pages/profile') }}">Profile</a> -->
                        <button type="submit" class="button-1">Seller Centre</button>
                    </form>

                    <form action="{{ url('pages/editprofile') }}/{{ Auth::user()->id }}" method="GET">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <button type="submit" class="button-2">Edit Profile</button>
                    </form>

                </div>

            </div>

            <hr>

            <div class="history-profile">
                <label>History</label>
            </div>


            @foreach ($dataall as $item)
                    <form action="/post/history/{{ $item->id }}" class="second-content" method="get">
                        <div class="wrap-history">
                            <label>No. Order : {{ $item->id }}</label> 
                            <p>Status : {{ $item->status }} </p>
                             

                            <span>Order Date : <p>{{ date('d-m-y', strtotime( $item->created_at )) }}</p> </span>
                            <span>Total : <p>Rp. {{ $item->totalprice }},00</p> </span>
                             
                        </div>
                        <button type="submit" >Detail</button>
                    </form>
                    @endforeach

        </div>
    </section>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"
        integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous">
    </script>
</body>

</html>