<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link href="../css/main.css" rel="stylesheet"/>

</head>
<body>
    <div class="nav-container">
        <section>
            <img src="{{ asset('images/logo.png') }}">
            @if(request()->fullUrl() != url('pages/profile') )
            <form action="" method="POST">
                 @csrf
                 <i class="bi bi-search"></i>
                <input type="text" name="search" placeholder="Search Products..." required/>
            </form>
            @endif
            <div class="dropdown">
                <div class="nav-profile"  data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ asset('images/profile.png') }}">
                    <p>{{ Auth::user()->name }}</p>
                </div>
                    <ul class="dropdown-menu">
                        <li>
                            <form action="{{ route('profile') }}" method="POST">
                                @csrf
                                <input type="hidden" name="user_id">
                                <a class="dropdown-item" href="{{ url('pages/profile') }}">Profile</a>
                            </form>
                        </li>
                        <li><a class="dropdown-item" href="#">Cart</a></li>
                        <li class="self-drop"><a class="dropdown-item" href="#"><i class="bi bi-box-arrow-left"></i> Logout</a></li>
                    </ul>
            </div>
        </section>
    </div>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
</body>
</html>