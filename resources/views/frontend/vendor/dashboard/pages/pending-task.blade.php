@extends('frontend.vendor.dashboard.layout.app')
@section('custom-styles')
    <style type="text/css">
        .service-row{ width: 90%; margin: auto; }
        .col-md-2 { align-items: center; display: flex;}
        .btn-primary, .btn-danger{ width: 100%;}
        img { width: 100%; }
    </style>

@endsection
@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Pending Tasks</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('vendorDashboard')}}">Home</a></li>
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
                            <!-- {{ $task->user->profile_photo}} -->
                            {{ $task->user->name }}<br>
                            
                          </td>
                          <td>{{ $task->deadline }}</td>
                          <td>{{ $task->budget }}</td>
                          <td>{{ $task->status }}</td>
                          <td class="text-center">
                           
                            <a href="{{route('rejectTask',$task->id)}}" class="btn btn-danger btn-sm w-50 d-inline">Reject</a>
                            <a href="{{ route('vendorChat', $task) }}" class="btn btn-warning btn-sm w-50 d-inline">Accept</a>
                             <a href="{{ route('vendorChat', $task) }}" class="btn btn-info btn-sm">Chat</a>
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

