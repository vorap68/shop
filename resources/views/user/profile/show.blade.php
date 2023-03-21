@extends('layouts.site', ['title' => 'Просмотр профиля'])

@section('content')
<h1>Просмотр профиля</h1>
<div class="row">
    <div class="col-md-6">
        <p> <strong>Название:</strong> {{$profile->title}}</p>
        <p><strong> Пользователь:</strong> {{$profile->name}}</p>
        <p><strong>Почта</strong>{{$profile->email}}</p>
         <p><strong>Телефон</strong>{{$profile->phone}}</p>
            <p><strong>Адрес</strong>{{$profile->address}}</p>
    </div>
<form action="{{route('user.profile.destroy',['profile'=>$profile->id])}}" method="post">
    @csrf
    @method('DELETE')
    
    <button type="submit" class="btn btn-danger">Удалить</button
</form>














@endsection