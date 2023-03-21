<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Helpers\ProductFilter;

class CatalogController extends Controller {

    public function index() {
        $roots = Category::where('parent_id', 0)->get();
        return view('catalog.index', compact('roots'));
    }
//
//    public function category($category) {
//        dd($category);
//       // $category = Category::where('slug', $slug)->firstOrFail();
//        return view('catalog.category', compact('category'));
//    }
     public function category(Request $request ,Category $category) {
         $builder = Product::where('category_id',$category->id);
         //dd($request->query());
        $products = (new ProductFilter($builder, $request))->apply()->paginate(6)->withQueryString();
        return view('catalog.category', compact('category','products'));
    }

    public function brand(Brand $brand) {
        //$brand = Brand::where('slug', $slug)->firstOrFail();
        return view('catalog.brand', compact('brand'));
    }

    public function product(Product $product) {
        //$product = Product::where('slug', $slug)->firstOrFail();
        return view('catalog.product', compact('product'));
    }

    //Этот метод ищет только в имени товара
    public function search(Request $request ) {
        $search = $request->input('query');
        $query = Product::search($search);
        $products = $query->paginate(5)->withQueryString();
        return view('catalog.search', compact('products', 'search'));
        
    }
}
