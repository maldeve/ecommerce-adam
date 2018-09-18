<ul class="list-group">
    @foreach ($categs as $item)
        <li class="list-group-item disabled"><a href="/posts?month={{$item->month}}&year={{$item->year}}">{{$item->month}}-{{$item->year}}({{$item->published}})</a></li>
    @endforeach
</ul>