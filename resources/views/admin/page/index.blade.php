@extends('layouts.admin',['title'=>'Все страницы сайта'])

@section('content')
<div class="container">
    <h1>Все страницы сайта</h1>
    <a href="{{route('admin.page.create')}}" class="btn btn-success mb-4"> создать страницу</a>

    <table class="table table-bordered">
           <tr>
                <th>#</th>
                <th width="45%">Наименование</th>
                <th width="45%">ЧПУ (англ.)</th>
                <th><i class="fas fa-edit"></i></th>
                <th><i class="fas fa-trash-alt"></i></th>
            </tr>
              @include('admin.page.part.tree')
    </table>


</div>



@endsection



