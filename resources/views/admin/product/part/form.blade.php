@csrf
<div class="form-group">
    @csrf
    <div class="form-group">
        <input type="text" class="form-control" name="name" placeholder="Наименование"
               required maxlength="100" value="{{ old('name') ?? $product->name ?? '' }}">
    </div>
    <div class="form-group">
        <input type="text" class="form-control" name="slug" placeholder="ЧПУ (на англ.)"
               required maxlength="100" value="{{ old('slug') ?? $product->slug ?? '' }}">
    </div>
    <div class="form-group ">
        <!-- Цена-->
        <input type="text" class="form-control w-25 d-inline mr-4" placeholder="Цена"
               name="price" required  value="{{old('price') ?? $product->price ?? ''}}"
           
     <!-- новинка -->
    <div class="form-check form-check-inline">
        @php
            $checked = false; // создание нового товара
            if (isset($product)) $checked = $product->new; // редактирование товара
            if (old('new')) $checked = true; // были ошибки при заполнении формы
        @endphp
        <input type="checkbox" name="new" class="form-check-input" id="new-product"
               @if($checked) checked @endif value="1">
        <label class="form-check-label" for="new-product">Новинка</label>
    </div>
    <!-- лидер продаж -->
    <div class="form-check form-check-inline">
        @php
            $checked = false; // создание нового товара
            if (isset($product)) $checked = $product->hit; // редактирование товара
            if (old('hit')) $checked = true; // были ошибки при заполнении формы
        @endphp
        <input type="checkbox" name="hit" class="form-check-input" id="hit-product"
               @if($checked) checked @endif value="1">
        <label class="form-check-label" for="hit-product">Лидер продаж</label>
    </div>
    <!-- распродажа -->
    <div class="form-check form-check-inline ">
        @php
            $checked = false; // создание нового товара
            if (isset($product)) $checked = $product->sale; // редактирование товара
            if (old('sale')) $checked = true; // были ошибки при заполнении формы
        @endphp
        <input type="checkbox" name="sale" class="form-check-input" id="sale-product"
               @if($checked) checked @endif value="1">
        <label class="form-check-label" for="sale-product">Распродажа</label>
    </div>
    </div>
    <div class="form-group">
    <textarea name="content" placeholder="Краткое описание" maxlength="600" cols="100" rows="3">
              {{old('product') ?? $product->content ?? ''}}
    </textarea>
</div>
    <div class="form-group">
        @php 
        $category_id = old('category_id') ?? $product->category_id ?? 0;
        @endphp
        <select class="form-control" name="category_id" title="категории">
            <option value="0">Выберите</option>
            @foreach($categories as $category)
           
            <option value="{{$category->id}}" @if ($category->id == $category_id) selected @endif >
                    {{$category->name}}</option>
             @endforeach
        </select>
    </div>
    
      <div class="form-group">
        @php 
        $brand_id = old('brand_id') ?? $product->brand_id ?? 0;
        @endphp
        <select class="form-control" name="brand_id" title="бренды">
            <option value="0">Выберите</option>
            @foreach($brands as $brand)
           
            <option value="{{$brand->id}}" @if ($brand->id == $brand_id) selected @endif >
                    {{$brand->name}}</option>
             @endforeach
        </select>
    </div>
    
    <div class="form-group">
        <input type='file' name="image">
    </div>
    
    @isset($product->image)
    <div class="form-group form-check">
        <input type="checkbox" name="remove" id="remove" class="form-check-input">
        <label class="form-check-label" for="remove">Удалить загруженое изображение</label>
    </div>
    @endisset
    
    <button type='submit' class="btn btn-success"> Сохранить</button>
</div>