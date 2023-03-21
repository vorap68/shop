<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Basket;
use Illuminate\Support\Facades\DB;

class Product extends Model {

    use HasFactory;

    protected $fillable = [
           'name',
        'slug',
        'content',
        'image',
        'category_id',
        'brand_id',
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function brand() {
        return $this->belongsTo(Brand::class);
    }

    public function baskets() {
        return $this->belongsToMany(Basket::class)->withPivot('quantity');
    }

    /**
     * Позволяет искать товары по заданным словам
     *
     * @param \Illuminate\Database\Eloquent\Builder $query  это экземпляр построителя запроса
     * @param string $search
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch($query, $search) {
        // Объект $query  если к нему применить метод получения данных get()
        // то он возвращает то же самое что и обращение к БД в виде
        // $data = DB::table('products')->get()
        
        // обрезаем поисковый запрос
        $search = iconv_substr($search, 0, 64);
        // удаляем все, кроме букв и цифр
        $search = preg_replace('#[^0-9a-zA-ZА-Яа-яёЁ]#u', ' ', $search);
        // сжимаем двойные пробелы
        $search = preg_replace('#\s+#u', ' ', $search);
        $search = trim($search);
        //dd($search);
        if (empty($search)) {
            return $query->whereNull('id'); // возвращаем пустой результат
        }
        // разбиваем поисковый запрос на отдельные слова
        $temp = explode(' ', $search);
      //  dd($temp);
        $words = [];
      //  $stemmer = new LinguaStemRu();
        foreach ($temp as $item) {
         
                $words[] = $item;
            
        }
         //$query = $query->Where('products.name', 'like', '%' . $search . '%');

//        $query->join('categories', 'categories.id', '=', 'products.category_id')
//            ->join('brands', 'brands.id', '=', 'products.brand_id')
//            ->select('products.*', DB::raw($relevance . ' as relevance'))
//            ->where('products.name', 'like', '%' . $words[0] . '%')
//            ->orWhere('products.content', 'like', '%' . $words[0] . '%')
//            ->orWhere('categories.name', 'like', '%' . $words[0] . '%')
//            ->orWhere('brands.name', 'like', '%' . $words[0] . '%');
       // dd($query);
        for ($i = 0; $i < count($words); $i++) {
           // dd($words[$i]);
            $query = $query->Where('products.name', 'like', '%' . $words[$i] . '%');
//            $query = $query->orWhere('products.content', 'like', '%' . $words[$i] . '%');
//            $query = $query->orWhere('categories.name', 'like', '%' . $words[$i] . '%');
//            $query = $query->orWhere('brands.name', 'like', '%' . $words[$i] . '%');
        }
       // $query->orderBy('relevance', 'desc');
        return $query;
    }
    
}
