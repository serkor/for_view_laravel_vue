<ul class="dropdown-menu">
    @foreach($children as $child)
        <li class="dropdown-submenu">
            <a href="{{route('category',$child->id)}}">{{$child->name}}</a>
            @if(count($child->children))
                @include('site.categories.children',['children' => $child->children])
            @endif
        </li>
    @endforeach
</ul>
