<li class="nav-item dropdown {{ $active }}">
    <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
        data-bs-auto-close="outside" role="button" aria-expanded="false">
        <span
            class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
            {!! $icon !!}
        </span>
        <span class="nav-link-title">
            {{ $name }}
        </span>
    </a>
    <div class="dropdown-menu">
        <div class="dropdown-menu-columns">
            @foreach ($dropdowns as $items)
            <div class="dropdown-menu-column">
                @foreach ($items as $item)
                    @livewire('dropdown-item',['name'=>$item['name'],'route'=>$item['route']])
                @endforeach
            </div>
            @endforeach
        </div>
    </div>
</li>
