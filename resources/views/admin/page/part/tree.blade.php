@foreach($pages as $page)
<tr>
    <td>
        <a href="{{route('admin.page.show',['page'=>$page->id])}}" 
           style="font-weight: bold">
            {{$page->name}}</a>
    </td>
    <td> {{ $page->name }}</td>
    <td> {{ $page->slug }}</td>
    <td>
        <a href="{{route('admin.page.edit',['page'=>$page->id])}}">
            <i class="far fa-edit"></i>
        </a>
    </td>
    <td>
        <form action="{{route('admin.page.destroy',['page'=>$page->id])}}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="m-0 p-0 border-0 bg-transparent">
                <i class="far fa-trash-alt text-danger"></i>
            </button>
        </form>
    </td>
</tr>
@endforeach  


