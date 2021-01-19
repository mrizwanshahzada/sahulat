@extends('backend.layout.app')
@section('custom-styles')
    <style type="text/css">
        .service-row{ width: 90%; margin: auto; }
        .col-md-2 { align-items: center;}
        .btn-primary, .btn-danger{ width: 100%; margin: 1%;}
        img { width: 100%; }
        p {padding: 0; margin: 0;}
    </style>
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Track Employees</h1>
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
{{--                    SAMPLE DATA--}}
            <div class="row service-row">

                <div class="col-md-1">
                    <img src="storage/images/user-profile-images/no-photo.jpg" width="200" height="70" class="rounded-circle">
                </div>
                <div class="col-md-3">
                    <h4>Sample Name</h4>
                </div>
                <div class="col-md-3">
                    <h4>Sample</h4>
                </div>
                <div class="col-md-3">
                    <h5>Sample</h5>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('trackEmployeeLocation') }}" class="btn btn-primary">Track</a>
                </div>

            </div>
        </section>
    </div>
@endsection
