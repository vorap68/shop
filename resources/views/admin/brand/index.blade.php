@extends('layouts.admin', ['title' => 'Все бренды каталога'])

@section('content')
<h1>Все бренды</h1>
<button type="submit" class="btn btn-link">
<a href="{{route('admin.brand.create')}}">Создать бренд</a>
</button>
<table class="table table-bordered">
     <tr>
            <th width="30%">Наименование</th>
            <th width="65%">Описание</th>
            <th><i class="fas fa-edit"></i></th>
            <th><i class="fas fa-trash-alt"></i></th>
        </tr>

    @include('admin.brand.part.tree',['items'=>$brands])
</table>>
@endsection



