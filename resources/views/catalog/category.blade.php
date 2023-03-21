@extends('layouts.site')

@section('content')

<h1>Категория:{{ $category->name }}</h1>

<p>{{ $category->content }}</p>

<div class="bg-info p-2 mb-4">
      <form method="get"
              action="{{ route('catalog.category', ['category' => $category->slug]) }}">
            @include('catalog.parts.filter')
            <a href="{{ route('catalog.category', ['category' => $category->slug]) }}"
               class="btn btn-light">Сбросить</a>
        </form>
</div>
<div class="row">
    @foreach ($products as $product)
    @include('catalog.parts.product')
    @endforeach

</div>
@endsection