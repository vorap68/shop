@extends('layouts.admin', ['title' => 'Создание бренда'])

@section('content')
<h1>Создание ново бренда</h1>
<form action="{{route('admin.brand.store')}}" method="post" enctype="multipart/form-data">
    @include('admin.brand.part.form')
</form>    


@endsection
