@extends('frontend.employee.layouts.app')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Vendor Verification Tasks</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Employee Dashboard</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div id="content">
               <div class="container applications-content">
                  <table class="table table-bordered">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">Vendor Name</th>
                        <th scope="col">Phone </th>
                        <th scope="col">Company Name </th>
                        <th scope="col">Location</th>
                        <th scope="col">Action</th>


                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($tasks as $task)
                        <tr>
                          <th scope="row">
                            {{ $task->vendor->user->name }}</th>
                          <td>{{ $task->vendor->user->phone }}</td>
                          <td>{{ $task->vendor->company_name }}</td>

                          <td><a href="{{route('trackVendorLocation',$task->id)}}" class="btn btn-success btn-sm"  >View</a></td>

                          <td>
                            <a id="{{$task->id}}" href="#" class="location-btn btn btn-danger btn-sm verify" data-lat="{{$task->vendor->user->latitude}}"
                            data-long ="{{$task->vendor->user->longitude}}">Verify</a>
                            <a id="{{$task->id}}" href="#" class="location-btn btn btn-warning btn-sm deny" data-lat="{{$task->vendor->user->latitude}}"
                            data-long ="{{$task->vendor->user->longitude}}">Deny</a>
                            <p id="demo"></p>
                          </td>

                        </tr>
                      @endforeach
                    </tbody>
                  </table>
               </div>
            </div>
        </section>




        <!-- /.content -->
    </div>

@endsection

@section('custom-scripts')
<script type="text/javascript">

      var lat1 = 0;
      var lon1 = 0;

        var x = document.getElementById("demo");
        var taskID = document.querySelectorAll(".location-btn");
        taskID.forEach(function(e) {
        e.addEventListener("click", function() {
                lat1 =this.dataset.lat;
                lon1 =  this.dataset.long;
           getLocation(this.getAttribute('id'))
        });
    });

    var id;

    function getLocation(taskId) {
      id = taskId;
      var lat = 'new value';
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
      } else {
        x.innerHTML = "Geolocation is not supported by this browser.";
      }
    }

    function showPosition(position) {


      var lat2 = position.coords.latitude;
      var lon2 = position.coords.longitude;
      var distance = calcCrow(lat1,lon1,lat2,lon2);

      if(distance < 1){
          $('.verify').click(function() {
            requestProcess("Verified");
          });
          $('.deny').click(function() {
            requestProcess("Denied");
          });
      }
      else{
        alert('You are not on Vendor Location');
      }


    }

    function requestProcess(status) {
      $.ajax({
          url:'{{route('employeeVerifyVendor')}}',
          method: "post",
          data: {"id":id, "status":status, "_token": "{{ csrf_token() }}"},
          success:function(result)
          {
            if(result != ""){
              location.reload();
            }
          }
      });
    }

    function calcCrow(lat1, lon1, lat2, lon2)
    {
      var R = 6371; // km
      var dLat = toRad(lat2-lat1);
      var dLon = toRad(lon2-lon1);
      var lat1 = toRad(lat1);
      var lat2 = toRad(lat2);

      var a = Math.sin(dLat/2) * Math.sin(dLat/2) +
        Math.sin(dLon/2) * Math.sin(dLon/2) * Math.cos(lat1) * Math.cos(lat2);
      var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
      var d = R * c;
      return d;
    }

    // Converts numeric degrees to radians
    function toRad(Value)
    {
        return Value * Math.PI / 180;
    }

</script>
@endsection
