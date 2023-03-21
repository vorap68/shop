@extends('layouts.admin', ['title' => 'Редактирование профиля'])

@section('content')
 <h1>Редактирование профиля</h1>
 <form action="{{route('user.profile.update',['profile'=>$profile->id])}}"
       method="post"  enctype="multipart/form-data">
     @method('PUT')
     @csrf
      @include('user.profile.part.form')
  </form>


@endsection
