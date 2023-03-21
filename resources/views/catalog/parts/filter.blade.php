<select name="price" class="form-control d-inline w-25 mr-4" title="Цена">
    <option value="0">Выберите цену</option>
    <option value="min"@if(request()->price == 'min') selected @endif>Дешевые товары</option>
    <option value="max"@if(request()->price == 'max') selected @endif>Дорогие товары</option>
</select>


<div class="form-check form-check-inline">
    <input type="checkbox" name="new1" id="new-product" class="form-check-input" 
           @if(request()->has('new1')) checked @endif value="yes">
           <label class="form-check-label" for="new-product">Новинка</label>
   </div>
<div class="form-check form-check-inline">
    <input type="checkbox" name="hit" id="hit-product" class="form-check-input" 
           @if(request()->has('hit')) checked @endif value="yes">
           <label class="form-check-label" for="new-product"> Хит продаж</label>
   </div>
<div class="form-check form-check-inline">
    <input type="checkbox" name="sale" id="sale-product" class="form-check-input" 
           @if(request()->has('sale')) checked @endif value="yes">
           <label class="form-check-label" for="new-product">Распродажа</label>
   </div>
<button type='submit' class="btn btn-link"> Фильтровать</button>