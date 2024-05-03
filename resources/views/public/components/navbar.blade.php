@php
$segment = Request::segment(1) ?? 'home';
@endphp

<nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
    <a href="/" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
        <img src="{{asset('template/logo/logo-nav.png')}}" alt="logo-nav" width="200" >
    </a>
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">
            @foreach ($menu as $item)
                @if (empty($item->is_admin) && $item->sub_menu->isEmpty())
                    <a href="/" class="nav-item nav-link {{$segment == $item->prefix ? 'active' : ''}}">{{$item->name}}</a>
                @endif
                @if (empty($item->is_admin) && !$item->sub_menu->isEmpty())
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle {{$segment == $item->prefix ? 'active' : ''}}" data-bs-toggle="dropdown">{{$item->name}}</a>
                        <div class="dropdown-menu fade-up m-0">
                        @foreach ($item->sub_menu as $item_sub_menu)
                            <a href="{{route($item_sub_menu->route)}}" class="dropdown-item {{$segment == $item_sub_menu->prefix ? 'active' : ''}}">{{$item_sub_menu->name}}</a>
                        @endforeach
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</nav>
