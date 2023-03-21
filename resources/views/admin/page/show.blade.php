@extends('layouts.admin', ['title' => 'Просмотр страницы'])

@section('content')
<h1>Просмотр страницы</h1>
<div class="row">
    <div class="col-md-6">
        <p> <strong>Название:</strong> {{$page->name}}</p>
        <p><strong> Чпу(англ):</strong> {{$page->slug}}</p>
       <p><strong>Краткое описание</strong></p>
            @isset($page->content)
                <p>{{ $page->content }}</p>
            @else
                <p>Описание отсутствует</p>
            @endisset
        </div>
      
    </div>
<form action="{{route('admin.page.destroy',['page'=>$page->id])}}" method="post">
    @csrf
    @method('DELETE')
    
    <button type="submit" class="btn btn-danger">Удалить</button
</form>














@endsection