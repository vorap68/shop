@extends('layouts.admin',['title'=>'Редактирование товара'])

@section('content')
<h1>Редактирование товара</h1>
<form action="{{route('admin.product.update',['product'=>$product->id])}}" method="post" enctype="multipart/form-data">
    @method('PUT')
     @include('admin.product.part.form')
</form>

@endsection