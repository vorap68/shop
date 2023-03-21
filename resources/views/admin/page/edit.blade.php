@extends('layouts.admin', ['title' => 'Редактирование страницы'])

@section('content')
 <h1>Редактирование страницы</h1>
 <form action="{{route('admin.page.update',['page'=>$page->id])}}"
       method="post" >
     @method('PUT')
     @csrf
      @include('admin.page.part.form')
  </form>


@endsection
