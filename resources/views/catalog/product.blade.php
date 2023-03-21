@extends('layouts.site')

<?php

//dd($product);
?>
@section('content')
        <h1>Товар: {{$product->name}}</h1>
        <div class="col-md-6">
         <p>Цена: {{ number_format($product->price, 2, '.', '') }}</p>
         <p>{{$product->id}}</p>
           <div class="col-md-6 position-relative">
                        <div class="position-absolute">
                            @if($product->new)
                                <span class="badge badge-info text-white ml-1">Новинка</span>
                            @endif
                            @if($product->hit)
                                <span class="badge badge-danger ml-1">Лидер продаж</span>
                            @endif
                            @if($product->sale)
                                <span class="badge badge-success ml-1">Распродажа</span>
                            @endif
                        </div>
                        @if($product->image)
                            @php $url = url('storage/catalog/product/image/' . $product->image) @endphp
                            <img src="{{ $url }}" alt="" class="img-fluid">
                        @else
                            <img src="https://via.placeholder.com/600x300" alt="" class="img-fluid">
                        @endif
                    </div>
         <form action="{{route('basket.add',['id' => $product->id])}}" method="POST"  class="form-inline add-to-basket">
             @csrf
             <label for="input-quantity">количество</label>
             <input type="text" name="quantity" id="input-quantity" value="1" class="form-control mx-2 w-25">
                 <button type="submit" class="btn btn-success">Добавить в корзину</button>
         </form>
        </div>
       @if($product->category)
    Категория:
         <a href="{{ route('catalog.category', [$product->category->slug]) }}">
        {{$product->category->name }}
    </a>
@endif
<br>
@if($product->brand)
    Бренд:

         <a href="{{ route('catalog.brand', [$product->brand->slug]) }}">
        {{ $product->brand->name }}
    </a>
@endif

<p>{{ $product->content }}</p>
    @endsection