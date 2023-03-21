@extends('layouts.admin',['title'=>'Редактирование  данных пользователя'])

@section('content')
<h1>Редактирование данных пользователя</h1>
<form  method="post" action="{{route('admin.user.update',['user'=>$user->id])}}">
    @csrf
    @method('PUT')
    <div class="form-group">
        <input type="text" class="form-control" name="name" placeholder="Имя,Фамилие"
               required maxlength="255" value="{{old('name') ?? $user->name ?? '' }}">
    </div>
     <div class="form-group">
        <input type="email" class="form-control" name="email" placeholder="email"
               required maxlength="255" value="{{old('email') ?? $user->email ?? '' }}">
    </div>
     <div class="form-group form-check">
         <input type="checkbox" class="form-check-input" name="change_password" id="change_password">
         <label class="form-check-label" for="change_password">
                Изменить пароль пользователя
            </label>
    </div>
    <div class="form-group">
        <input type="text" class="form-control" name="password" placeholder="новый пароль"
               required maxlength="255" value="">
    </div>
      <div class="form-group">
        <input type="text" class="form-control" name="password_confirmation" placeholder="пароль еще раз"
               required maxlength="255" value="">
    </div>
     <div class="form-group">
    <button type="submit" class="btn btn-success">Сохранить</button>
     </div>
</form>

@endsection