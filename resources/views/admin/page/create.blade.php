@extends('layouts.admin', ['title' => 'Создание страницы'])

@section('content')
<h1>Создание новой страницы</h1>
<form action="{{route('admin.page.store')}}" method="post" >
    @include('admin.page.part.form')
</form>    


@endsection
