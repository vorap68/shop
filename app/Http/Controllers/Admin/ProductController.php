<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Helpers\ImageSaver;
use App\Models\Category;
use App\Models\Brand;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    private $imageSaver;
    
    public function __construct() {
        $this->imageSaver = new ImageSaver;
        
    }
    public function index()
    {
        $products = Product::paginate(5);
        return view('admin/product.index',compact('products'));
    }

       public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.product.create',compact('categories','brands'));
    }

       public function store(ProductRequest $request)
    {
            $request->merge([
            'new' => $request->has('new'),
            'hit' => $request->has('hit'),
            'sale' => $request->has('sale'),
        ]);
       $data = $request->all();
       $name = $this->imageSaver->upload($request,null,'product');
       $data['image'] = $name;
       Product::create($data);
       return redirect()->route('admin.product.index')->
               with('success','Продукт создан');
    }

       public function show(Product $product)
    {
           $product = Product::find($product->id);
           $category = $product->category->name;
           $brand = $product->brand->name;
           //dd($category_name);;
        return view('admin.product.show',compact('product','category','brand'));
    }

    
    public function edit(Product $product)
    {
       $categories = Category::all();
        $brands = Brand::all();
        return view('admin.product.edit',compact('product','categories','brands'));
       
    }

  
    public function update(ProductRequest $request, Product $product)
    {
         $request->merge([
            'new' => $request->has('new'),
            'hit' => $request->has('hit'),
            'sale' => $request->has('sale'),
        ]);
        $data = $request->all();
        $name = $this->imageSaver->upload($request,$product,'product');
        $data['image'] = $name;
        $product->update($data);
        return redirect()->route('admin.product.show',['product'=>$product->id])
                ->with('success','Товар успешно изменен');
        
        }

   
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.product.index')->
                with('success','Товар успешно удален');
    }
}
