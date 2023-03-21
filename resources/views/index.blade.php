@extends('layouts.site')


@section('content')
<h1>интернет магазин</h1>

<p>
    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
</p>

@if($hit->count())
<h2>Лидеры продаж</h2>
<div class="row">
@foreach($hit as $item)
@include('catalog.parts.product',['product'=>$item])
@endforeach
</div>
@endif

@if($new->count())
<h2>Новинки</h2>
<div class="row">
@foreach($new as $item)
@include('catalog.parts.product',['product'=>$item])
@endforeach
</div>
@endif

@if($sale->count())
<h2>Распродажа</h2>
<div class="row">
@foreach($sale as $item)
@include('catalog.parts.product',['product'=>$item])
@endforeach
</div>
@endif



@endsection