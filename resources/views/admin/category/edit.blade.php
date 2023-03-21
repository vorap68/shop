@extends('layouts.admin', ['title' => 'Редактирование категории'])

@section('content')
 <h1>Редактирование категории</h1>
 <form action="{{route('admin.category.update',['category'=>$category->id])}}"
       method="post"  enctype="multipart/form-data">
     @method('PUT')
     @csrf
      @include('admin.category.part.form')
  </form>


@endsection
