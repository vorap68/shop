@extends('layouts.admin', ['title' => 'Все категории каталога'])

@section('content')
<h1>Все категории</h1>
<button type="submit" class="btn btn-link">
<a href="{{route('admin.category.create')}}">Создать категорию</a>
</button>
<table class="table table-bordered">
     <tr>
            <th width="30%">Наименование</th>
            <th width="65%">Описание</th>
            <th><i class="fas fa-edit"></i></th>
            <th><i class="fas fa-trash-alt"></i></th>
        </tr>

    @include('admin.category.part.tree',['items'=>$roots,'level'=>-1])
</table>
@endsection



