  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('customerDashboard') }}" class="brand-link">
      <img src="{{ asset('admin-lte/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Customer Dashboard</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../storage/images/user-profile-images/{{Auth::user()->profile_photo}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info d-flex align-items-center">
          <a href="{{route('customerProfile')}}" class="d-block">{{Auth()->user()->name}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-item">
            <a href="{{ route('customerDashboard') }}" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Current Tasks
                <i>({{count(Auth::user()->tasks->where('status','In Progress'))}})</i>
              </p>
            </a>
          </li>
          <li class="nav-item">
                <a href="{{ route('customerVerifyingTasks') }}" class="nav-link">
                    <i class="nav-icon fas fa-book"></i>
                    <p>
                        Verifying Task
                        <i>({{count(Auth::user()->tasks->where('status','Verifying'))}})</i>
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('completedTasks') }}" class="nav-link">
                    <i class="nav-icon fas fa-book"></i>
                    <p>
                        Completed Tasks
                        <i>({{count(Auth::user()->tasks->where('status','Completed'))}})</i>
                    </p>
                </a>
            </li>




             <li class="nav-item">
                <a href="{{ route('customerPendingTasks') }}" class="nav-link">
                    <i class="nav-icon fas fa-book"></i>
                    <p>
                        Pending Tasks
                        <i>({{count(Auth::user()->tasks->where('status','Pending'))}})</i>
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('mySubscription') }}" class="nav-link">
                    <i class="nav-icon fas fa-book"></i>
                    <p>
                        Subscription
                        <i>({{count(Auth::user()->subscriptions)}})</i>
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('transactionHistory') }}" class="nav-link">
                    <i class="nav-icon fas fa-book"></i>
                    <p>
                        My Transaction History
                    </p>
                </a>
            </li>

        </ul>

          <div class="row" style="position: absolute; bottom: 0; width: 100%; background: #0f6674">
              <a href="{{ route('logoutCustomer') }}" class="brand-link" style="width: 100%; text-align: center;">
                  <i class="fas fa-exclamation-circle"></i>
                  <span>Logout</span>
              </a>
          </div>

      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
