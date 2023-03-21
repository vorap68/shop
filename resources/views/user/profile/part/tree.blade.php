@if(count($items))


@foreach($items as $item)
<tr>
    <td>{{$loop->iteration}}</td>
     <td> {{$item->title}}</td>
    <td> {{$item->name}}</td>
     <td> {{$item->email}}</td>
      <td> {{$item->phone}}</td>
    <td>
        <a href="{{route('user.profile.edit',['profile'=>$item->id])}}">
      <i class="far fa-edit"></i>
        </a>
    </td>
    <td>
        <form action="{{route('user.profile.destroy',['profile'=>$item->id])}}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="m-0 p-0 border-0 bg-transparent">
        <i class="far fa-trash-alt text-danger"></i>
            </button>
        </form>
    </td>

</tr>


@endforeach  
@endif

