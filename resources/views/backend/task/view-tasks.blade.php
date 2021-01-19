@extends('backend.layout.app')
@section('custom-styles')
    <style type="text/css">
        .service-row { width: 90%; margin: auto; background: #E5E8E8;}
        .header-row { background: #95A5A6; color: white; }
        .col-2, .col-md-2 { padding: 1% 0 0 1%;}
        hr { width: 90%; margin: auto; }
        .task-details { padding: 10% 0; }
    </style>
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">{{ $data['type'] }} Tasks</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
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
            <div class="container-fluid">

                <!-- Header -->
                @if(count($data['tasks']) > 0)
                    <div class="row service-row header-row">
                        <div class="col-md-2 col-sm-2 col-2">
                            <h6 align="center">Service</h6>
                        </div>
                        <div class="col-md-2 col-sm-2 col-2">
                            <h6 align="center">{{ $data['type'] }}</h6>
                        </div>
                        <div class="col-md-2 col-sm-2 col-2">
                            <h6 align="center">Customer</h6>
                        </div>
                        <div class="col-md-2 col-sm-2 col-2">
                            <h6 align="center">Status</h6>
                        </div>
                        <div class="col-md-2 col-sm-2 col-2">
                            <h6 align="center">Budget</h6>
                        </div>
                        <div class="col-md-2 col-sm-2 col-2">
                            <h6 align="center">Deadline</h6>
                        </div>
                    </div>
                @endif
                <!-- Rows -->
                @foreach($data['tasks'] as $task)
                    <div class="row service-row">
                        <div class="col-md-2 col-sm-2 col-2">
                            <center><img src="../storage/images/service-images/{{ $task->service->service_image }}" class="rounded-circle img-fluid" width="70" height="70"></center>
                            <h6 align="center">{{ $task->service->title }}</h6>
                        </div>
                        <div class="col-md-2 col-sm-2 col-2">
                            <center><img src="../storage/images/user-profile-images/{{ $task->{$data['type']}->user->profile_photo }}"  class="rounded-circle img-fluid" width="70" height="70"></center>
                            <h6 align="center">{{ $task->{$data['type']}->user->name }}</h6>
                        </div>
                        <div class="col-md-2 col-sm-2 col-2">
                            <center><img src="../storage/images/user-profile-images/{{ $task->user->profile_photo }}" class="rounded-circle img-fluid" width="70" height="70"></center>
                            <h6 align="center">{{ $task->user->name }}</h6>
                        </div>
                        <div class="col-md-2 col-sm-2 col-2">
                            <h6 align="center" class="task-details">{{ $task->status }}</h6>
                        </div>
                        <div class="col-md-2 col-sm-2 col-2">
                            <h6 align="center" class="task-details">Rs {{ $task->budget }}</h6>
                        </div>
                        <div class="col-md-2 col-sm-2 col-2">
                            <h6 align="center" class="task-details">{{ $task->created_at->format('d M Y') }}</h6>
                        </div>
                    </div>
                    <hr>
                @endforeach
            </div>
        </section>
    </div>
@endsection
