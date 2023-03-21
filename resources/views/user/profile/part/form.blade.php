<input type="hidden" name="user_id" value="{{auth()->user()->id}}" >
<div class="form-group">
    <input type="text" name="title" class="form-control" placeholder="Название профиля" required
           maxlength="255" value="{{old('title') ?? $profile->title ?? ''}}">
</div>
<div class="form-group">
    <input type="text" name="name" class="form-control" placeholder="Имя ,Фамилие" required
           maxlength="255" value="{{old('name') ?? $profile->name ?? ''}}">
</div>
<div class="form-group">
    <input type="email" name="email" class="form-control" placeholder=" Почта" required
           maxlength="255" value="{{old('email') ?? $profile->email ?? ''}}">
</div>
<div class="form-group">
    <input type="text" name="phone" class="form-control" placeholder="Телефон" required
           maxlength="255" value="{{old('phone') ?? $profile->phone ?? ''}}">
     </div>
<div class="form-group">
    <input type="text" class="form-control" name="address" placeholder="Адрес доставки"
           required maxlength="255" value="{{ old('address') ?? $profile->address ?? '' }}">
</div>
<div class="form-group">
    <textarea class="form-control" name="comment" placeholder="Комментарий"
              maxlength="255" rows="2">{{ old('comment') ?? $profile->comment ?? '' }}</textarea>
</div>
<div class="form-group">
    <button type="submit" class="btn btn-success">Сохранить профиль</button>
</div>