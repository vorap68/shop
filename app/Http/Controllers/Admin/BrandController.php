<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Helpers\ImageSaver;
use App\Http\Requests\CategoryCatalogRequest;

class BrandController extends Controller {

    private $imageSaver;

    public function __construct() {
        $this->imageSaver = new ImageSaver;
    }

    public function index() {
        $brands = Brand::all();
        return view('admin.brand.index', compact('brands'));
    }

    public function create() {
        return view('admin.brand.create');
    }

    public function store(CategoryCatalogRequest $request) {
        $data = $request->all();
        $data['image'] = $this->imageSaver->upload($request, null, 'brand');
        $brand = Brand::create($data);
        return redirect()->route('admin.brand.show', ['brand' => $brand->id])
                        ->with('success', 'Новый бренд успешно создан');
    }

    public function show(Brand $brand) {
        $id = $brand->id;
        $brand = Brand::find($id);
        return view('admin.brand.show', compact('brand'));
    }

    public function edit(Brand $brand) {
        return view('admin.brand.edit', compact('brand'));
    }

    public function update(CategoryCatalogRequest $request, Brand $brand) {
        $data = $request->all();
        $data['image'] = $this->imageSaver->upload($request, $brand,'brand');
        $brand->update($data);
        return redirect()->route('admin.brand.show', ['brand' => $brand->id])
                        ->with('success', 'Бренд был успешно отредактирован');
    }

    public function destroy(Brand $brand) {
        if ($brand->products->count()) {
            $errors[] = 'Нельзя удалить бренд, который содержит товары';
        }
        if (!empty($errors)) {
            return back()->withErrors($errors);
        }
        $brand->delete();
        return redirect()->route('admin.brand.index')
                        ->with('success', 'Бренд каталога успешно удален');
    }

}
