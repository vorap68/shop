<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::all();
        return view('admin.page.index',compact('pages'));
    }

   
    public function create()
    {
        return view('admin.page.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate( 
               [ 'name' => 'required|max:100',
            'slug' => 'required|max:100|unique:pages|regex:~^[-_a-z0-9]+$~i',
            'content' => 'required',]
                   );
        $page = Page::create($data);
       return redirect()->route('admin.page.show',['page'=>$page->id])
                ->with('success','Страница успешно создана');
    }

   public function show(Page $page)
    {
        return view('admin.page.show',compact('page'));
    }

  
    public function edit(Page $page)
    {
       return view('admin.page.edit', compact('page'));
    }

   
    public function update(Request $request, Page $page)
    {
          $data = $request->validate( 
               [ 'name' => 'required|max:100',
            'slug' => 'required|max:100|unique:pages|regex:~^[-_a-z0-9]+$~i',
            'content' => 'required',]
                   );
       $page->update($data);
       return redirect()->route('admin.page.show',['page'=>$page->id])
                ->with('success','Страница успешно отредактирована');
    }

   
    public function destroy(Page $page)
    {
        $page->delete();
        return redirect()->route('admin.page.index')->
                with('success','Страница успешно удалена');
    }
}
