@extends('layouts.admin', ['title' => 'Редактирование бренда'])

@section('content')
 <h1>Редактирование бренда</h1>
 <form action="{{route('admin.brand.update',['brand'=>$brand->id])}}"
       method="post"  enctype="multipart/form-data">
     @method('PUT')
     @csrf
      @include('admin.brand.part.form')
  </form>


@endsection
