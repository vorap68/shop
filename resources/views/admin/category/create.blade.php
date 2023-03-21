@extends('layouts.admin', ['title' => 'Создание категории'])

@section('content')
<h1>Создание новой категории</h1>
<form action="{{route('admin.category.store')}}" method="post" enctype="multipart/form-data">
    @include('admin.category.part.form')
</form>    


@endsection
