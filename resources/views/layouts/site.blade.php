<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Магазин</title>
             <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css" rel="stylesheet">
      <link rel="stylesheet" href="{{ asset('css/app.css') }}">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/site.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
    </head>
    
    <body>
        
        <div class="container">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="/">Магазин</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Каталог</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Контакты</a>
      </li>
          <li class="nav-item">
        <a class="nav-link disabled">Доставка</a>
      </li>
    </ul>
      
      <form action="{{route('catalog.search')}} "class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" name="query"
           placeholder="Поиск по каталогу" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
      
        <!-- Этот блок расположен справа -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item" id="top_basket">
                <a class="nav-link @if($positions) text-success @endif" href="{{ route('basket.index') }}">Корзина</a>
                @if($positions) {{$positions}}@endif
            </li>
               @guest
        <li class="nav-item">
            <a class="nav-link" href="{{ route('user.login') }}">Войти</a>
        </li>
        @if (Route::has('user.register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.register') }}">Регистрация</a>
            </li>
        @endif
    @else
        <li class="nav-item">
            <a class="nav-link" href="{{ route('user.index') }}">Личный кабинет</a>
        </li>
    @endif
        </ul>
  </div>
</nav>
<div class="row">
        <div class="col-md-3">
            @include('layouts.parts.roots')
             @include('layouts.parts.brands')
<!--            <h4>Разделы каталога</h4>
            <p>Здесь будут корневые разделы</p>
            <h4>Популярные бренды</h4>
            <p>Здесь будут популярные бренды</p>-->
        </div>
        <div class="col-md-9">
           
             @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible mt-4" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Закрыть">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ $message }}
            </div>
           @endif
            
           @if ($errors->any())
        <div class="alert alert-danger alert-dismissible mt-0" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Закрыть">
                <span aria-hidden="true">&times;</span>
            </button>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
            @yield('content')
        </div>      
        </div>
      
    </body>
</html>