<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use Illuminate\Support\Facades\Cookie;

class Basket extends Model {

    use HasFactory;

    public function products() {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }

    public function increase($id, $count = 1) {
        $this->change($id, $count);
    }

    public function decrease($id, $count = 1) {
        $this->change($id, -1 * $count);
    }

    private function change($id, $count = 0) {
        if ($count == 0) {
            return;
        }
        //$basket = Basket::findOrFail($basket_id);
        //эта строка не нужна ,тк в сущности в $this уже находиться объект класса Basket 
        // и у него id = basket_id  тк basket_product.basket_id = basket.id 
        // если товар есть в корзине — изменяем кол-во
        if ($this->products->contains($id)) {
            // получаем объект строки таблицы `basket_product`
            $pivotRow = $this->products()->where('product_id', $id)->first()->pivot;
            $quantity = $pivotRow->quantity + $count;
            if ($quantity > 0) {
                // обновляем количество товара $id в корзине
                $pivotRow->update(['quantity' => $quantity]);
            } else {
                // кол-во равно нулю — удаляем товар из корзины
                $pivotRow->delete();
            }
        } elseif ($count > 0) { // иначе — добавляем этот товар
            $this->products()->attach($id, ['quantity' => $count]);
        }
        // обновляем поле `updated_at` таблицы `baskets`
        $this->touch();
    }

    /**
     * Удаляет товар с идентификатором $id из корзины покупателя
     */
    public function remove($id) {
        // удаляем товар из корзины (разрушаем связь)
        $this->products()->detach($id);
        // обновляем поле `updated_at` таблицы `baskets`
        $this->touch();
    }
    
    public static function getCount() {
      $basket_id = request()->cookie('basket_id');
        //dd($basket_id);
        if (empty($basket_id)) {
            return 0;
        }
       // $tempBasket = self::getBasket();
        //dd($tempBasket);
        return self::getBasket()->products->count();
    }

    public static  function getBasket() {
        $basket_id = request()->cookie('basket_id');
        //dd($basket_id);
        if(!empty($basket_id)){
//            try {
//               // $basket = Basket::findOrFail($basket_id);
//                $basket = Basket::find($basket_id);
//                dd($basket);
//            } catch (ModelNotFoundException $e) {
//                $basket = Basket::create();
 //           }
            $basket = Basket::find($basket_id);
            if(empty($basket)) $basket = Basket::create();
            
        }else{
         $basket = Basket::create();
    }
     Cookie::queue('basket_id',$basket->id,525600);
     return $basket;
    }
    
  
     public function getAmount() {
        $amount = 0.0;
        foreach ($this->products as $product) {
            $amount = $amount + $product->price * $product->pivot->quantity;
        }
        return $amount;
    }
    
}
