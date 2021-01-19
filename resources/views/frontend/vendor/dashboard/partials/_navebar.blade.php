 <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">

        <a href="{{route('/')}}" class="nav-link">Home</a>

      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('contact') }}" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->

      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">


            {{Auth::user()->vendor->unreadNotifications->count()}}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

              @foreach(Auth::user()->vendor->unreadNotifications as $notification)
                @if($notification->data['title'] == 'Assigned')
                <a href="{{route('assignVendorTask')}}" class="dropdown-item">
                @elseif($notification->data['title'] == 'Completed')
                <a href="{{route('completeTasks')}}" class="dropdown-item">@elseif($notification->data['title'] == 'Canceled')
                <a href="{{route('vendorCanceledTask')}}" class="dropdown-item">@elseif($notification->data['title'] == 'Pending')
                <a href="{{route('pandingTasks')}}" class="dropdown-item">
                @elseif($notification->data['title'] == 'In Progress')
                <a href="{{route('vendorCurrentTask')}}" class="dropdown-item">
                @elseif($notification->data['title'] == 'Verifying')
                <a href="{{route('vendorVerifyingTask')}}" class="dropdown-item">
                @elseif($notification->data['title'] == 'Rejected Offer')
                <a href="{{route('vendorChat', $notification->data['taskId'])}}" class="dropdown-item">
                @endif
                    <div class="media">
                      <img src="../storage/images/user-profile-images/{{ $notification->data['userImage'] }}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                      <div class="media-body">
                          <p class="small">{{ $notification->data['msg'] }}</p>
                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> {{ date('h:i A M d Y', strtotime($notification->created_at)) }} </p>
                      </div>
                    </div>
                </a>

              @endforeach
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
