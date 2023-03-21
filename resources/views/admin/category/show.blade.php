@extends('layouts.admin', ['title' => 'Просмотр категории'])

@section('content')
<h1>Просмотр категории</h1>
<div class="row">
    <div class="col-md-6">
        <p> <strong>Название:</strong> {{$category->name}}</p>
        <p><strong> Чпу(англ):</strong> {{$category->slug}}</p>
       <p><strong>Краткое описание</strong></p>
            @isset($category->content)
                <p>{{ $category->content }}</p>
            @else
                <p>Описание отсутствует</p>
            @endisset
        </div>
        <div class="col-md-6">
            @php
           if($category->image){
          // $url = Storage::disk('public')->url('catalog/category/image/'.$category->image);
            //$url = Storage::disk('public')->url('catalog/category/image/' . $category->image);
            $url = url('storage/catalog/category/image/' . $category->image);
            }else {
            $url = url('storage/catalog/category/image/default.jpg');}
               echo $url;

                      
            @endphp
            
              <img src="{{$url}}" alt="" class="img-fluid">
        </div>
    </div>
<form action="{{route('admin.category.destroy',['category'=>$category->id])}}" method="post">
    @csrf
    @method('DELETE')
    
    <button type="submit" class="btn btn-danger">Удалить</button
</form>














@endsection