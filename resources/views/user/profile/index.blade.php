@extends('layouts.site', ['title' => 'Все профили'])

@section('content')

<h1> Личный кабинет</h1>
<p>Добро пожаловать {{auth()->user()->name}}</p>
<p>Это личный кабинет постоянного покупателя нашего интернет-магазина.</p>

<button type="submit" class="btn btn-link">
<a href="{{route('user.profile.create')}}">Создать профиль</a>
</button>
<h1>Ваши профили</h1>

@if(count($profiles))
<table class="table table-bordered">
     <tr>
                <th>№</th>
                <th width="22%">Наименование</th>
                <th width="22%">Имя, Фамилия</th>
                <th width="22%">Адрес почты</th>
                <th width="22%">Номер телефона</th>
                <th><i class="fas fa-edit"></i></th>
                <th><i class="fas fa-trash-alt"></i></th>
            </tr>

    @include('user.profile.part.tree',['items'=>$profiles])
</table>
@else У вас нет профилей
@endif
<form action="{{route('user.logout')}}" method="post">
    @csrf
    <button type='submit'>Выйти</button>
</form>
@endsection



