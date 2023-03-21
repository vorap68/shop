<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Basket;
use Illuminate\Support\Facades\Cookie;
use App\Models\Order;
use App\Models\Profile;

class BasketController extends Controller {

    private $basket;
 
    public function __construct() {
        //dd(777);
        //$this->getBasket();
         $this->basket = Basket::getBasket();
    }

  /**
     * Показывает корзину покупателя
     */
    public function index() {
        $products = $this->basket->products;
        return view('basket.index', compact('products'));
    }

    public function checkout(Request $request) {
        $profiles = null;
        $profile = null;
        if(auth()->check()){
            $user = auth()->user();// если пользователь аутентифицирован
             // ...и у него есть профили для оформления
            $profiles = $user->profiles;
            // ...и был запрошен профиль для оформления
            $prof_id = (int)$request->input('profile_id');
            $profile = $user->profiles()->where('id',$prof_id)->where('user_id',$user->id)->first();
            return view('basket.checkout', compact('profiles','profile'));
        }
        return view('basket.checkout');
    }

     public function add(Request $request, $id) {
        $quantity = $request->input('quantity') ?? 1;
        //dd($quantity);
        $this->basket->increase($id, $quantity);
         if ( ! $request->ajax()) {
            // выполняем редирект обратно на ту страницу,
            // где была нажата кнопка «В корзину»
            return back();
        }
        // в случае ajax-запроса возвращаем html-код корзины в правом
        // верхнем углу, чтобы заменить исходный html-код, потому что
        // теперь количество позиций будет другим
        $positions = $this->basket->products->count();
        return view('basket.part.basket', compact('positions'));
    }
    
   
    public function plus($id) {
        $this->basket->increase($id);
        return redirect()->route('basket.index');
    }

    public function minus($id) {
        $this->basket->decrease($id);
        return redirect()->route('basket.index');
    }

    
    
    /**
     * Удаляет товар с идентификаторм $id из корзины
     */
    public function remove($id) {
        $this->basket->remove($id);
        // выполняем редирект обратно на страницу корзины
        return redirect()->route('basket.index');
    }

    /**
     * Полностью очищает содержимое корзины покупателя
     */
    public function clear() {
        $this->basket->delete();
        // выполняем редирект обратно на страницу корзины
        return redirect()->route('basket.index');
    }
    
  public function saveorder(Request $request) {
         $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|max:255',
            'address' => 'required|max:255',
        ]);
        //dd($request);
         // валидация пройдена, сохраняем заказ
        $basket = Basket::getBasket();
        //dd($basket);
        $user_id = auth()->check() ? auth()->user()->id : null;
        //dd($user_id);
        $order = Order::create(
            $request->all() + ['amount' => $basket->getAmount(), 'user_id' => $user_id]
        );
        //dd($basket->products);
        // здесь перебираем массив из тех товаров которые попали в данный заказ 
        // эти товары были в одной корзине поэтому  в одном поле в таблице baskets
        //и поэтому имеют один basket_id  в таблице basket_product
        foreach ($basket->products as $product) {
            $order->items()->create([
                'product_id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $product->pivot->quantity,
                'cost' => $product->price * $product->pivot->quantity,
            ]);
        }
        
          // уничтожаем корзину
        $basket->delete();

        return redirect()
            ->route('basket.success')
            ->with('order_id', $order->id);
    }
    
    
    public function success(Request $request) {
        if($request->session()->exists('order_id')){
            $order_id = $request->session()->pull('order_id');
            $order = Order::findOrFail($order_id);
            return view('basket.success',compact('order'));
        }else{
         redirect()->route('basket.index');
        }
        
    }
     public function profile(Request $request) {
        if ( ! $request->ajax()) {
            abort(404);
        }
        if ( ! auth()->check()) {
            return response()->json(['error' => 'Нужна авторизация!'], 404);
        }
        $user = auth()->user();
        $profile_id = (int)$request->input('profile_id');
        if ($profile_id) {
            $profile = $user->profiles()->whereIdAndUserId($profile_id, $user->id)->first();
            if ($profile) {
                return response()->json(['profile' => $profile]);
            }
        }
        return response()->json(['error' => 'Профиль не найден!'], 404);
    
}
}
