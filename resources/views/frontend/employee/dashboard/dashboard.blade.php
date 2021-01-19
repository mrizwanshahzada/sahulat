@extends('frontend.employee.layouts.app')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Current Tasks</h1>
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
                        <th scope="col">Title</th>
                        <th scope="col">Customer</th>
                        <th scope="col">Start Date</th>
                        <th scope="col">Deadline</th>
                        <th scope="col">Budget</th>
                        <th scope="col">Status</th>
                        <th scope="col" class="text-center">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($tasks as $task)
                        <tr>
                          <th scope="row">{{ $task->service->title }}</th>
                          <td>
                            {{ $task->user->name }}
                          </td>
                          <td>{{ $task->start_date }}</td>
                          <td>{{ $task->deadline }}</td>
                          <td>{{ $task->budget }}</td>
                          <td>{{ $task->status }}</td>
                          <td>
                            <a href="{{route('employeeDoneTask',$task)}}" onclick="getLastLocation()" class="btn btn-warning btn-sm" onclick="stopWork()">Done</a>
                            <a href="{{ route('employeeChat', $task->id) }}" class="btn btn-info btn-sm">Chat</a>
                            <a href="#" class="btn btn-success btn-sm location-btn" id="{{$task->id}}" onclick="getLocation()">Track me</a>
                            
                            
                            
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


@section('scripts')
 <!-- <script type="text/javascript" src="{{asset('assets/js/demo_workers.js') }}"></script> -->
<script type="text/javascript">

           var taskID = document.querySelectorAll(".location-btn");
            taskID.forEach(function(e) {
            e.addEventListener("click", function() {
            getLocation(this.getAttribute('id'))

            });
            });
            console.log(taskID)

            var id;

                function getLocation(taskId) {
                  console.log(taskId)
                  id = taskId
                  alert("Track your location");
                   counter = "start";
                   newCounter=0;
                  if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(showPosition);
                  } else { 
                    // x.innerHTML = "Geolocation is not supported by this browser.";
                  }
                }
                  
                function showPosition(position) {
                // A single iteration of your calculation function
                // log the current value of counter as an example
                // then wait before doing the next iteration
                  function printCounter() {
                    console.log(counter);            
                     $.post(
                      '{{route("employeeUpdateLocation")}}', 
                         {
                            latitude: position.coords.latitude,
                            longitude: position.coords.longitude,
                            newCounter: newCounter,
                            taskId:id,
                            _token: $('meta[name="csrf-token"]').attr('content')
                          }, 
                            function(){
                            // console.log('sent');
                              // console.log(id);
                              // console.log(newCounter);
                            console.log(position.coords.latitude);
                            

                          }); 
                    if (counter == "start"){
                      setTimeout(printCounter, 1000);
                    }
                    newCounter++;
                  }
                  // Start the loop
                  printCounter();

                } //end of show position

            function stopWork(){
                  counter= "stop";
            }

            // get last location
            function getLastLocation(){

                function getLocation() {
                  if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(showPosition);
                  } else {
                     alert("Geolocation is not supported by this browser.");
                  }
                }

                function showPosition(position) {
                       $.post(
                         '{{route("employeeLastLocation")}}', 
                         {
                            latitude: position.coords.latitude,
                            longitude: position.coords.longitude,
                            newCounter: newCounter,
                            _token: $('meta[name="csrf-token"]').attr('content')
                          }, 
                            function(){
                            console.log(position.coords.latitude);
                            

                          }); // end of post
                }
            }
       
      </script>
       

@endsection
