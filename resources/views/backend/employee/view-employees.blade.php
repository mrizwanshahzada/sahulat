@extends('backend.layout.app')
@section('custom-styles')
    <style type="text/css">
        .service-row { width: 90%; margin: auto; background: #E5E8E8; padding: 1%;}
        .header-row { background: #95A5A6; color: white; padding: 1%;}
        .col-md-2 { align-items: center;}
        .btn-primary, .btn-danger{ width: 100%; margin: 1%;}
        img { width: 100%; }
        p {padding: 0; margin: 0;}
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
                        <h1 class="m-0 text-dark">Manage Employees</h1>
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
                <div class="row service-row header-row">
                        <div class="col-md-4 col-sm-2 col-2">
                            <h6>Employee Details</h6>
                        </div>
                        <div class="col-md-1 col-sm-1 col-1">
                            <h6>Rating</h6>
                        </div>
                        <div class="col-md-1 col-sm-1 col-1">
                            <h6>Salary</h6>
                        </div>
                        <div class="col-md-3 col-sm-3 col-3">
                            <h6>Employee Location</h6>
                        </div>
                        <div class="col-md-3 col-sm-2 col-2">
                            <h6 align="center">Action</h6>
                        </div>
                    </div>

                <!-- Rows -->
                @foreach($employees as $employee)
                    <div class="row service-row">
                        <div class="col-md-1">
                            <img src="storage/images/user-profile-images/{{ $employee->user->profile_photo }}" width="100" class="rounded-circle">
                        </div>
                        <div class="col-md-3">
                            <h6><strong>{{ $employee->user->name }}</strong></h6>
                            <p>{{ $employee->user->email }}</p>
                        </div>
                        <div class="col-md-1">
                            <p>{{ $employee->rating }}</p>
                        </div>
                        <div class="col-md-1">
                            <p>{{ $employee->salary }}</p>
                        </div>
                        <div class="col-md-3">
                            <p>{{ $employee->user->address }}</p>
                            <p>{{ $employee->status }}</p>
                        </div>
                        <div class="col-md-3">
                            <a style="display: inline; width: 45%; float: left;" href="{{ route('editEmployee', $employee->id) }}" class="btn btn-primary">Update</a>
                            <a style="display: inline; width: 45%; float: left;" href="#" class="btn btn-danger">Remove</a>
                        </div>
                    </div>
                    <hr>
                @endforeach
            </div>
        </section>
    </div>
@endsection
