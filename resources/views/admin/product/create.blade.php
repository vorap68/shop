@extends('layouts.admin', ['title' => 'Создание товара'])

@section('content')
<h1>Создание нового товара</h1>
<form action="{{route('admin.product.store')}}" method="post" enctype="multipart/form-data">
    
    @include('admin.product.part.form')
</form>




@endsection