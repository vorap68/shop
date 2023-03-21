@extends('layouts.site')

@section('content')
<h3>Создание профиля</h3>
<form action="{{route('user.profile.store')}}" method="post" class="form-group">
    @csrf
    @include('user.profile.part.form')
</form>



@endsection
