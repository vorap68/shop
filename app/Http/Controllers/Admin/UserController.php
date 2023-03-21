<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
       $users = User::all();
     return view('admin.user.index',compact('users'));
    }

  
    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {
        //
    }

    public function show(User $user)
    {
        //
    }

  
    public function edit(User $user)
    {
      return view('admin.user.edit',compact('user'));
    }

 
    public function update(Request $request, User $user)
    {
       /*
         * Проверяем данные формы
         */
        $this->validator($request->all(), $user->id)->validate();
        /*
         * Обновляем пользователя
         */
          if ($request->change_password) { // если надо изменить пароль
            $request->merge(['password' => Hash::make($request->password)]);
            $user->update($request->all());
        } else {
            $user->update($request->except('password'));
        }
        /*
         * Возвращаемся к списку
         */
        return redirect()
            ->route('admin.user.index')
            ->with('success', 'Данные пользователя успешно обновлены');
    }

    

    public function destroy(User $user)
    {
        //
    }
    
    private function validator(array $data ,$id) {
        
        $rules =  [
            'name' => [
                'required',
                'string',
                'max:255'
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                // проверка на уникальность email, исключая
                // этого пользователя по идентифкатору
                'unique:users,email,'.$id.',id',
            ],
        ];
        if(isset($data['change_password'])){
             $rules['password'] = ['required', 'string', 'min:8', 'confirmed'];
        }
        return Validator::make($data,$rules);   
    }
}
