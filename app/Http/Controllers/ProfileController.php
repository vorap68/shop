<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
    $profiles = auth()->user()->profiles;
       return view('user.profile.index',compact('profiles'));
    }

   
    public function create()
    {
        return view('user.profile.create');
    }

    public function store(Request $request)
    {
       // dd($request->input('user_id'));
        $data = $request->validate([
             'user_id' => 'in:' . auth()->user()->id,
            'title' => 'required|max:255',
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|max:255',
            'address' => 'required|max:255',
        ]);
       $profile = Profile::create($data);
       return redirect()->route('user.profile.show',['profile'=>$profile->id])
               ->with('success','Профиль успешно создан');
       }

    public function show(Profile $profile)
      {
         $id = $profile->id;
        $profile = Profile::find($id);
        return view('user.profile.show', compact('profile'));
    }

    public function edit(Profile $profile)
    {   
        if($profile->id !== auth()->user()->id)  abort(404);// Чужой профиль
        return view('user.profile.edit',compact('profile'));
    }

   
    public function update(Request $request, Profile $profile)
    {
        $data = $request->validate([
              'user_id' => 'in:' . auth()->user()->id,
            'title' => 'required|max:255',
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|max:255',
            'address' => 'required|max:255',
        ]);
        
        $profile->update($data);
        return redirect()->route('user.profile.show',['profile'=>$profile->id])
                ->with('success', 'Профиль был успешно отредактирован');
    }

    public function destroy(Profile $profile)
    {
        if($profile->id !== auth()->user()->id) abort(404);
        $profile->delete();
         return redirect()
            ->route('user.profile.index')
            ->with('success', 'Профиль был успешно удален');
    }
}
