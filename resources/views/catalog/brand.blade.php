@extends('layouts.site')

@section('content')
    <h1>Название бренда: {{ $brand->name }}</h1>

    <p>{{ $brand->content }}</p>

    <div class="row">
        @foreach ($brand->products as $product)
           @include('catalog.parts.product')
        @endforeach
    </div>
@endsection