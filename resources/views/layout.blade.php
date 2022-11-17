<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Отзывы</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="/styles/styles.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.css" integrity="sha512-DD6Lm09YDHzhW3K4eLJ9Y7sFrBwtCF+KuSWOLYFqKsZ6RX4ifCu9vWqM4R+Uy++aBWe6wD4csgQRzGKp5vP6tg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    @yield('link')
</head>
<body>
<header class="container">
    <nav class="navbar navbar-dark navbar-expand-lg bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{route('welcome')}}">Отзывы</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{route('index')}}">Города</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('all_reviews')}}">Все Отзывы</a>
                    </li>
                    @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('add_review')}}">Добавить отзыв</a>
                    </li>
                    @endauth
                </ul>
                @guest
                <a href="{{route('login')}}" class="text-decoration-none px-3 text-white">Войти</a>
                <a href="{{route('register')}}" class="text-decoration-none text-white">Зарегистрироваться</a>
                @endguest
                @auth
                    <a href="{{route('profile',\Illuminate\Support\Facades\Auth::user()->id)}}" class="mx-2 text-decoration-none text-white">Профиль</a>
                    <a href="{{route('logout')}}" class="text-decoration-none text-white">Выйти</a>
                    @endauth
            </div>
        </div>
    </nav>
</header>
<script
    src="https://code.jquery.com/jquery-2.2.4.min.js"
    integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
    crossorigin="anonymous"></script>
@if ($errors->any())
    <div class="alert alert-danger container">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if ($message = Session::get('success'))
    <div class="alert alert-success alert-block container">
        <strong>{{ $message }}</strong>
    </div>
@endif
   @yield('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.1.2/js/star-rating.min.js" integrity="sha512-BjVoLC9Qjuh4uR64WRzkwGnbJ+05UxQZphP2n7TJE/b0D/onZ/vkhKTWpelfV6+8sLtQTUqvZQbvvGnzRZniTQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>
