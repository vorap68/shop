@extends('layouts.site', ['title' => 'Поиск по каталогу'])

@section('content')
    <h1>Поиск по каталогу</h1>
    <p>Поисковый запрос: {{ $search ?? 'пусто' }}</p>
    @if (count($products))
        <div class="row">
            @foreach ($products as $product)
                @include('catalog.parts.product', ['product' => $product])
            @endforeach
        </div>
        {{ $products->links() }}
    @else
        <p>По вашему запросу ничего не найдено</p>
    @endif
@endsection