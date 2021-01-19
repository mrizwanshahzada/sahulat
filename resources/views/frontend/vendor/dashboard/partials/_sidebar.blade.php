
   <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->

    <a href="{{route('vendorDashboard')}}" class="brand-link">
      <img src="{{ asset('admin-lte/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Vendor Panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../storage/images/user-profile-images/{{Auth::user()->profile_photo}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">

          <a href="#" class="d-block">{{Auth::user()->name}}</a>

        </div>
      </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->

                <li class="nav-item">

                    <a href="{{route('pandingTasks')}}" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Pending Tasks
                            ({{ $data['vendor_pending_task'] }})
                        </p>
                    </a>
                </li>

                <li class="nav-item">

                    <a href="{{route('completeTasks')}}" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Completed Tasks
                            ({{ $data['vendor_complete_task'] }})
                        </p>
                    </a>
                </li>
<!-- 
                <li class="nav-item">

                    <a href="{{route('vendorCanceledTask')}}" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Canceled Tasks
                            ({{ $data['vendor_cancel_task'] }})
                        </p>
                    </a>
                </li> -->

                 <li class="nav-item">

                    <a href="{{route('vendorCurrentTask')}}" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Current Task
                            ({{ $data['vendor_current_task'] }})
                        </p>
                    </a>
                </li>

                 <li class="nav-item">

                    <a href="{{route('assignVendorTask')}}" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Assigned Tasks
                            ({{ $data['vendor_assigned_task'] }})
                        </p>
                    </a>
                </li>

                  <li class="nav-item">

                    <a href="{{route('vendorVerifyingTask')}}" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Verifying Tasks
                            ({{ $data['vendor_verifying_task'] }})
                        </p>
                    </a>
                </li>
            </ul>

            <div class="row" style="position: absolute; bottom: 0; width: 100%; background: #0f6674">
                <a href="{{ __('logout') }}" class="brand-link" style="width: 100%; text-align: center;">
                    <i class="fas fa-exclamation-circle"></i>
                    <span>Logout</span>
                </a>
            </div>

        </nav>
    </div>
    <!-- /.sidebar -->
  </aside>
