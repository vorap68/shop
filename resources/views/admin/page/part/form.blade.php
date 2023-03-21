@csrf
<div class="form-group">
    <input type="text" class="form-control" name="name" placeholder="Наименование"
           required maxlength="100" value="{{ old('name') ?? $page->name ?? '' }}">
</div>
<div class="form-group">
    <input type="text" class="form-control" name="slug" placeholder="ЧПУ"
           required maxlength="100" value="{{ old('slug') ?? $page->slug ?? '' }}">
</div>
<div class="form-group">
    <textarea name="content" id="editor" placeholder="Краткое описание" maxlength="600" cols="100" rows="3">
              {{old('content') ?? $page->content ?? ''}}
    </textarea>
</div>

<div class="form-group">
    <button type="submit" class="btn btn-primary">Сохранить</button>
</div>