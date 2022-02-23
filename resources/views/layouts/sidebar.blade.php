<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ \Illuminate\Support\Facades\Auth::user()->name }}</a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">
                    <a href="{{ url('/') }}" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                @permission('Invoces')
                    <li class="nav-header">Invoces</li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-table"></i>
                            <p>
                                Invoces
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @endpermission
                            @permission('Invoces')
                                <li class="nav-item">
                                    <a href="{{ route('invoces.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Invoces List</p>
                                    </a>
                                </li>
                                @endpermission
                                @permission('Invoces_paid')
                                    <li class="nav-item">
                                        <a href="{{ route('invoces_Paid') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Invoces paid</p>
                                        </a>
                                    </li>
                                    @endpermission
                                    @permission('Invoces_part_paid')
                                        <li class="nav-item">
                                            <a href="{{ route('invoces_part_Paid') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Invoces part paid</p>
                                            </a>
                                        </li>
                                        @endpermission
                                        @permission('Invoces_Unpaid')
                                            <li class="nav-item">
                                                <a href="{{ route('invoces_un_Paid') }}" class="nav-link">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>Invoces Un paid</p>
                                                </a>
                                            </li>
                                            @endpermission
                                            @permission('Reports')
                                                <li class="nav-item">
                                                    <a href="{{ route('trached_invoces') }}" class="nav-link">
                                                        <i class="far fa-circle nav-icon"></i>
                                                        <p>Invoces Trashed</p>
                                                    </a>
                                                </li>
                                                @endpermission
                                            </ul>
                                        </li>
                                        @permission('Reports')
                                            <li class="nav-header">Reports</li>
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">
                                                    <i class="nav-icon fas fa-table"></i>
                                                    <p>
                                                        Reports
                                                        <i class="fas fa-angle-left right"></i>
                                                    </p>
                                                </a>
                                                <ul class="nav nav-treeview">
                                                    @permission('ReportsInvoces')
                                                        <li class="nav-item">
                                                            <a href="{{ route('ReportsInvoces.index') }}" class="nav-link">
                                                                <i class="far fa-circle nav-icon"></i>
                                                                <p>Reports Invoces</p>
                                                            </a>
                                                        </li>
                                                        @endpermission
                                                    </ul>
                                                </li>
                                                @endpermission
                                                @permission('Roles|Users')
                                                    <li class="nav-header">Users&Roles</li>
                                                    <li class="nav-item">
                                                        <a href="#" class="nav-link">
                                                            <i class="nav-icon fas fa-table"></i>
                                                            <p>
                                                                Users&Roles
                                                                <i class="fas fa-angle-left right"></i>
                                                            </p>
                                                        </a>
                                                        <ul class="nav nav-treeview">
                                                            @permission('Users')
                                                                <li class="nav-item">
                                                                    <a href="{{ route('Users.index') }}" class="nav-link">
                                                                        <i class="far fa-circle nav-icon"></i>
                                                                        <p>Users</p>
                                                                    </a>
                                                                </li>
                                                                @endpermission
                                                                @permission('Roles')
                                                                    <li class="nav-item">
                                                                        <a href="{{ route('Roles.index') }}" class="nav-link">
                                                                            <i class="far fa-circle nav-icon"></i>
                                                                            <p>Roles</p>
                                                                        </a>
                                                                    </li>
                                                                    @endpermission
                                                                </ul>
                                                            </li>
                                                            @endpermission
                                                            @permission('Settings')
                                                                <li class="nav-header">Settings</li>
                                                                <li class="nav-item">
                                                                    <a href="#" class="nav-link">
                                                                        <i class="nav-icon fas fa-table"></i>
                                                                        <p>
                                                                            Settings
                                                                            <i class="fas fa-angle-left right"></i>
                                                                        </p>
                                                                    </a>
                                                                    <ul class="nav nav-treeview">
                                                                        @permission('Sections')
                                                                            <li class="nav-item">
                                                                                <a href="{{ route('section.index') }}" class="nav-link">
                                                                                    <i class="far fa-circle nav-icon"></i>
                                                                                    <p>Section</p>
                                                                                </a>
                                                                            </li>
                                                                            @endpermission
                                                                            @permission('Product')
                                                                                <li class="nav-item">
                                                                                    <a href="{{ route('products.index') }}" class="nav-link">
                                                                                        <i class="far fa-circle nav-icon"></i>
                                                                                        <p>Products</p>
                                                                                    </a>
                                                                                </li>
                                                                                @endpermission
                                                                            </ul>
                                                                        </li>

                                                                    @endpermission
                                                                        <hr>
                                                                        <li class="nav-item my-3 ">
                                                                            <form action="{{ route('logout') }}" method="post">
                                                                                @csrf
                                                                                <i class="nav-icon far fa-circle nav-icon"></i>
                                                                                <button type="submit"
                                                                                    style=" outline: none; border: none;background: none;margin: 0;padding: 0;margin-left: 10px;font-weight: bold;color: white;">Logout</button>
                                                                            </form>
                                                                        </li>
                                                                    </ul>
                                                                    </li>
                                                                </nav>
                                                                <!-- /.sidebar-menu -->
                                                            </div>
                                                            <!-- /.sidebar -->
                                                        </aside>
