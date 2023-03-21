<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Helpers\ImageSaver;
use App\Http\Requests\CategoryCatalogRequest;

class CategoryController extends Controller {

    private $imageSaver;

    public function __construct(ImageSaver $imageSaver) {
        $this->imageSaver = $imageSaver;
    }

    public function index() {
        $roots = Category::roots();
        return view('admin.category.index', compact('roots'));
    }

    public function create() {
        return view('admin.category.create');
    }

    public function store(CategoryCatalogRequest $request) {
        $category = new Category;

        $data = $request->all();

        $data['image'] = $this->imageSaver->upload($request, null, 'category');
        $category = Category::create($data);
        return redirect()
                        ->route('admin.category.show', ['category' => $category->id])
                        ->with('success', 'Новая категория успешно создана');
    }

    public function show(Category $category) {
        return view('admin.category.show', compact('category'));
    }

    public function edit(Category $category) {
        return view('admin.category.edit', compact('category'));
    }

    public function update(CategoryCatalogRequest $request, Category $category) {
        //$id = $category->id;
        $data = $request->all();
        $data['image'] = $this->imageSaver->upload($request, $category, 'category');
        $category->update($data);
        return redirect()->route('admin.category.show', ['category' => $category->id])
                        ->with('success', 'Категория была успешно исправлена');
    }

    public function destroy(Category $category) {
        if ($category->products->count()) {
            $errors[] = 'Нельзя удалить категорию, которая содержит товары';
        }
        if (!empty($errors)) {
            return back()->withErrors($errors);
        }
        $category->delete();
        return redirect()->route('admin.category.index')
                        ->with('success', 'Категория каталога успешно удалена');
    }

}
