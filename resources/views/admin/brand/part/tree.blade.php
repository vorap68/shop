@if(count($items))


@foreach($items as $item)
<tr>
    <td>
       
        <a href="{{route('admin.brand.show',['brand'=>$item->id])}}" 
           style="font-weight">
            {{$item->name}}</a>
    </td>
    <td> {{ iconv_substr($item->content, 0, 150) }}</td>
    <td>
        <a href="{{route('admin.brand.edit',['brand'=>$item->id])}}">
      <i class="far fa-edit"></i>
        </a>
    </td>
    <td>
        <form action="{{route('admin.brand.destroy',['brand'=>$item->id])}}" method="post">
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

