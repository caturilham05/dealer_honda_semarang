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
                            <a href="{{route($item->route)}}" class="nav-link {{Request::segment(2) == $item->prefix ? 'active' : ''}}">
                                <p>
                                    {{$item->name}}
                                </p>
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
