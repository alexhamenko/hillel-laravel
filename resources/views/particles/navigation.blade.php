<ul class="nav nav-tabs">
    @foreach($links as $link)
        <li class="nav-item">
            <a href="{{ $link['link'] }}" class="nav-link @if($link['current']) active @endif">{{ $link['name'] }}</a>
        </li>
    @endforeach
</ul>
