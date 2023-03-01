<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link href="../css/main.css" rel="stylesheet"/>

</head>
<body>
    
    <section class="container-background">
        <div class="container-mid">
            <img src="{{ asset('images/logo.png') }}" class="img-logo">
            <form action="{{ route('login') }}" method="post" class="form-auth">
                @csrf
                <label>LOGIN</label>
                @if ($errors->any())
                    <div class="error">
                    @foreach ($errors->all() as $message)
                        <p>{{ $message }}</p>
                    @endforeach
                    </div>
                @endif
                <span>Email</span>
                <input type="email" name="email" id="email">
                <span>Password</span>
                <input type="password" name="password" id="password">
                <button type="submit">LOGIN</button>
                <p>Doesn't Have an account? <a href="{{ url('auth/register') }}">Register</a></p>
            </form>
        </div>
    </section>

</body>
</html>