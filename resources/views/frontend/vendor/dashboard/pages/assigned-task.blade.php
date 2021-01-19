@extends('frontend.vendor.dashboard.layout.app')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Assigned Tasks</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('vendorDashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Vendor Dashboard</li>
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
                          <td width="20%">                      
                            <div class="ml-1 mt-2">{{ $task->user->name }}</div>
                          </td>
                          <span id="task" class="text-hide">{{$task}}</span>
                          <td>{{ $task->deadline }}</td>
                          <td>{{ $task->budget }}</td>
                          <td>{{ $task->status }}</td>
                          <td>
                            <a href="{{route('progresstaskStatus',$task->id)}}" class="btn btn-danger btn-sm">Start Work</a>
                                 
                            <p id="start"></p>                 
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



