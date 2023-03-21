@extends('layouts.admin', ['title' => 'Просмотр бренда'])

@section('content')
<h1>Просмотр бренда</h1>
<div class="row">
    <div class="col-md-6">
        <p> <strong>Название:</strong> {{$brand->name}}</p>
        <p><strong> Чпу(англ):</strong> {{$brand->slug}}</p>
       <p><strong>Краткое описание</strong></p>
            @isset($brand->content)
                <p>{{ $brand->content }}</p>
            @else
                <p>Описание отсутствует</p>
            @endisset
        </div>
        <div class="col-md-6">
            @php
           if($brand->image){
                    $url = url('storage/catalog/brand/image/'.$brand->image);
            }else {
            $url = url('storage/catalog/brand/image/default.jpg');}
               echo $url;

                      
            @endphp
            
              <img src="{{$url}}" alt="" class="img-fluid">
        </div>
    </div>
<form action="{{route('admin.brand.destroy',['brand'=>$brand->id])}}" method="post">
    @csrf
    @method('DELETE')
    
    <button type="submit" class="btn btn-danger">Удалить</button
</form>














@endsection