<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Category extends Model
{
    use HasFactory;
     protected $fillable = [
        'parent_id',
        'name',
        'slug',
        'content',
        'image',
    ];
    
    public function products() {
        $products = $this->hasMany(Product::class);
        return $products;
    }
    public  static function roots() {
       return self::where('parent_id',0)->get(); 
    }
}
