   <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('adminDashboard') }}" class="brand-link">
      <img src="{{ asset('admin-lte/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Admin Panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../storage/images/user-profile-images/{{ Auth::user()->profile_photo }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="{{ route('adminProfile') }}" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->

{{--                Manage Services --}}
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tasks"></i>
                        <p>
                            Manage Services
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('viewServices', 'Sahulat') }}" class="nav-link">
                                <i class="nav-icon fas fa-th-list"></i>
                                <p>
                                    Sahulat Services
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('viewServices', 'Vendors') }}" class="nav-link">
                                <i class="nav-icon fas fa-th-list"></i>
                                <p>
                                    Vendors Services
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>

{{--                View Tasks --}}
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tasks"></i>
                        <p>
                            View Tasks
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('viewTasks', 'Vendor') }}" class="nav-link">
                                <i class="nav-icon fas fa-th-list"></i>
                                <p>
                                    Vendors Tasks
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('viewTasks', 'Employee') }}" class="nav-link">
                                <i class="nav-icon fas fa-th-list"></i>
                                <p>
                                    Employees Tasks
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Vendors Management
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('viewVendorRequests') }}" class="nav-link">
                                <i class="nav-icon fas ion-person-add"></i>
                                <p>
                                    Vendors Requests ({{ $vendor_requests }})
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Employee Management
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('addNewEmployee') }}" class="nav-link">
                                <i class="nav-icon fas ion-person-add"></i>
                                <p>
                                    Add New Employee
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('viewEmployees') }}" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Manage Employees
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ route('trackEmployees') }}" class="nav-link">
                        <i class="nav-icon fas fa-map-marker"></i>
                        <p>
                            Track Employees
                        </p>
                    </a>
                </li>

            </ul>

            <div class="row" style="position: absolute; bottom: 0; width: 100%; background: #0f6674">
                <a href="{{ _('logout') }}" class="brand-link" style="width: 100%; text-align: center;">
                    <i class="fas fa-exclamation-circle"></i>
                    <span>Logout</span>
                </a>
            </div>

        </nav>
    </div>
    <!-- /.sidebar -->
  </aside>
