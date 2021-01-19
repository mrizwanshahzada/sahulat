 <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">

        <a href="{{ route('/') }}" class="nav-link">Home</a>

      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('contact') }}" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-danger navbar-badge">{{Auth::user()->employee->unreadNotifications->count()}}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

            <!-- Message Start -->
              @foreach(Auth::user()->employee->unreadNotifications as $notification)
                <a href="#" class="dropdown-item">
                    <div class="media">
                      
                      <img src="../storage/images/user-profile-images/{{$notification->data['userImage'] }}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                      <div class="media-body">
                        {{-- msg --}}
                          <p class="small">{{$notification->data['msg']}} </p>
                      </div>

                    </div> 
                    <div class="ml-2">
                        <a href="{{route('employeeReadNotification',$notification->id)}}" class="btn btn-sm btn-success ">Mark as read</a>
                        
                    </div>
                </a>
                <!-- Message End -->
              @endforeach
              

          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>

    </ul>
  </nav>
  <!-- /.navbar -->
