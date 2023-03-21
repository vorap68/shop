<form action="{{route('basket.checkout')}}" method="get" id="profiles">
    <div class='form-group'>
    
        <select name="profile_id" class="form-control">
            <option>Выберите профиль</option>>
        @foreach($profiles as $profile)
        <option value="{{$profile->id}}" @if($profile->id == $current ) selected @endif>{{$profile->title}}</option>
      @endforeach 
      </select>
    </div>
    <div class='form-group'>
        <button type="submit" class="btn btn-success">Выбрать</button>
    </div>
</form>