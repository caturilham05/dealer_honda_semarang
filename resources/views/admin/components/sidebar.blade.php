<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <center>
            <span class="brand-text font-weight-light">Admin</span>
            <br>
            <span class="brand-text font-weight-light"><b>Dealer Honda Semarang</b></span>
        </center>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                @foreach ($menu as $item)
                    @if (!empty($item->is_admin))
                        <li class="nav-item">
                            <a href="@if(!$item->sub_menu->isEmpty()) # @else {{route($item->route)}} @endif" class="nav-link {{Request::segment(2) == $item->prefix ? 'active' : ''}}">
                                <p>
                                    {{$item->name}}
                                    @if (!$item->sub_menu->isEmpty())
                                        <i class="fas fa-angle-left right"></i>
                                    @endif
                                </p>
                            </a>
                            @if (!$item->sub_menu->isEmpty())
                                @foreach ($item->sub_menu as $item_sub_menu)
                                    @if ($item_sub_menu->is_active == 1)                                    
                                        <ul class="nav nav-treeview">
                                            <li class="nav-item">
                                                <a href="{{route($item_sub_menu->route)}}" class="nav-link {{Request::segment(3) == $item_sub_menu->prefix ? 'active' : ''}}">
                                                  <i class="far fa-circle nav-icon"></i>
                                                  <p>{{$item_sub_menu->name}}</p>
                                                </a>
                                            </li>
                                        </ul>
                                    @endif
                                @endforeach
                            @endif
                        </li>
                    @endif
                @endforeach
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
