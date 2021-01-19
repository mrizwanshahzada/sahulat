
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">

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


    <ul class="navbar-nav ml-auto">

      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-danger navbar-badge">{{Auth::user()->unreadNotifications->count()}}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">



              @foreach(Auth::user()->unreadNotifications as $notification)
                     <!-- for links -->
                    @if($notification->data['title'] == 'Assigned' || $notification->data['title'] == 'In Progress')
                      <a href="{{route('customerDashboard')}}" class="dropdown-item">
                      @elseif($notification->data['title'] == 'Verifying')
                      <a href="{{route('customerVerifyingTasks')}}" class="dropdown-item">
                      @else
                      <a href="#" class="dropdown-item">
                    @endif
                    <!-- for links -->
                    <div class="media">
                        @if($notification->data['title'] == 'Subscription')
                            <img src="../storage/images/service-images/{{$notification->data['image'] }}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                        @else
                          <img src="../storage/images/user-profile-images/{{$notification->data['userImage'] }}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                        @endif
                            <div class="media-body">
                          <p class="small">{{ $notification->data['msg'] }}</p>
                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> {{ date('h:i A M d Y', strtotime($notification->created_at)) }} </p>

                      </div>

                    </div>
                 </a>

                @if($notification->data['title'] == 'Update')
                    <a href="{{route('requestVendor',[$notification->data['task_id'],$notification->id])}}" class="btn btn-success">Yes</a>
                    <a href="{{route('rejectOffer',[$notification->data['task_id'],$notification->id])}}" class="btn btn-danger">No</a>
                @endif
                @if($notification->data['title'] == 'Subscription')
                    <a href="{{ route('renewSubscription', [$notification->data['subscription_id'],$notification->id]) }}" class="btn btn-success">Yes</a>
                    <a href="{{ route('customerReadNotification', $notification->id) }}" class="btn btn-danger">No</a>
                @endif
                  <a href="{{route('customerReadNotification',$notification->id)}}" class="ml-3 btn  btn-success mt-3">Mark as read</a>


              @endforeach

          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>

    </ul>

  </nav>

