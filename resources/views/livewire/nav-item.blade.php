<li class="nav-item {{ $active }}">
    <a class="nav-link" href="{{ route($route) }}">
        <span
            class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
            {!! $icon !!}
        </span>
        <span class="nav-link-title">
            {{ $name }}
        </span>
    </a>
</li>
