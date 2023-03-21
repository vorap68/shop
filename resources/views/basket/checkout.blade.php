@extends('layouts.site')


@section('content')
@php
//dd($profile);
@endphp
@if($profiles && $profiles->count())
    @include('basket.select',['current'=>$profile->id ?? 0])
@endif
<h1>Оформить заказ</h1>
<form action="{{route('basket.saveorder')}}" method="post" id="checkout" >
    @csrf
    <div class="form-group">
        <input type="text" class="form-control" name="name" placeholder="Имя,Фамилия" 
               required maxlength="255" value="{{old('name') ?? $profile->name ?? ''}}">
         </div>
        <div class="form-group">
        <input type="email" class="form-control" name="email" placeholder="почта" 
               required  value="{{old('email') ?? $profile->email ?? ''}}">
         </div>
        <div class="form-group">
        <input type="text" class="form-control" name="phone" placeholder="телефон" 
               required maxlength="255" value="{{old('phone') ??$profile->phone ??  ''}}">
         </div>
        <div class="form-group">
        <input type="text" class="form-control" name="address" placeholder="адрес" 
               required maxlength="255" value="{{old('address') ?? $profile->address ?? ''}}">
         </div>
        <div class="form-group">

        <textarea class="form-control" name="comment" placeholder="Комментарии" 
                  maxlength="255" rows="2" value="{{old('comment') ?? ''}}"></textarea> 
    </div>
     
        <div class="form-group">
            <button type="submit" class="btn btn-success">Оформить</button>
</div>
</form>
@endsection