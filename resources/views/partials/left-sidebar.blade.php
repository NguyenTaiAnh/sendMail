@php
    $current_route=request()->route()->getName();
@endphp
    <!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
        <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">NguyenTaiAnh</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="dist/img/logoadmin.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{auth()->user()->name}}</a>
            </div>
        </div>


        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                @if(auth()->user() && auth()->user()->is_admin)
                <li class="nav-item">
                    <a href="{{route('dashboard')}}" class="nav-link {{$current_route=='dashboard'?'active':''}}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('/sendmail')}}" class="nav-link">
                        <i class="fa fa-paper-plane" aria-hidden="true"></i>
                        <p>
                            Send Email
                        </p>
                    </a>
                </li>
                <li class="nav-item {{$current_route=='users.index'?'menu-open':''}}">
                    <a href="#" class="nav-link {{$current_route=='users.index'?'active':''}}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            User Management
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('users.index')}}"
                               class="nav-link {{$current_route=='users.index'?'active':''}}">
                                <i class="far fas fa-user"></i>
                                <p>Users</p>
                            </a>
                        </li>

                    </ul>
                </li>
                @endif
                <li class="nav-item {{$current_route=='email.index'?'menu-open':''}}">
                    <a href="#" class="nav-link {{$current_route=='email.index'?'active':''}}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Emails Management
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('email.index')}}"
                               class="nav-link {{$current_route=='email.index'?'active':''}}">
                                <i class="far fas fa-user"></i>
                                <p>Emails</p>
                            </a>
                        </li>

                    </ul>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
