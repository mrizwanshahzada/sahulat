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
                        <h1 class="m-0 text-dark">Services</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('vendorDashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
       <section class="content">
            <div id="content">
                <div class="container applications-content">
                 <table class="table table-bordered">
                  @if(count($tasks)>0)
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">Title</th>
                        <th scope="col">User</th>
                        <th scope="col">Start Date</th>
                        <th scope="col">Finish Date</th>
                        <th scope="col">Budget</th>
                        <th scope="col">Status</th>
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
                          <td>{{ $task->finish_date }}</td>
                          <td>{{ $task->budget }}</td>
                          <td><span class="badge badge-success">{{ $task->status }}</span></td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                  @endif
                  @if(count($tasks)<=0)
                   <div><h5>You have not completed task</h5></div>
                  @endif
                </div>
            </div>
        </section>
    </div>
@endsection
