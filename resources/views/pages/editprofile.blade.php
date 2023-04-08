<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile Page</title>

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
                <label>Edit Profile</label>
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
            </div>
            <hr>

            <form action="{{ route('updateProfile') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="wrap-profile">

                    <div class="input-1">
                        <label>Name :</label>
                        <input type="text" name="name" id="name" value="{{ $cekuser->name }}">
                        <label>Email : </label>
                        <input type="text" name="email" id="email" value="{{ $cekuser->email }}" readonly>
                        <label>Address : </label>
                        <input type="text" name="address" id="address" value="{{ $cekuser->address }}" placeholder="Add Address">
                    </div>

                    <div class="input-2">
                        <label>Merchant Address :</label>
                        @if($cekuser->isSeller == 0)
                        <input type="text" name="merchant_address" id="merchant_address"
                            placeholder="You Are Not Seller" readonly>
                        @else
                        <input type="text" name="merchant_address" id="merchant_address"
                            value="{{ $cekuser->merchant_address }}" >
                        @endif
                        <label>Image Profile :</label>
                        <input type="file" name="profile" id="profile">
                        <label>Phone Number :</label>
                        <input type="text" name="number" id="number" value="{{ $cekuser->number }}">
                    </div>

                </div>

                <div class="wrap-button">
                    <button type="submit">Update Profile</button>
                </div>

                <hr>

            </form>
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