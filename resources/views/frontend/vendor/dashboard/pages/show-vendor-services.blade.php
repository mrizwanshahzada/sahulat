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
            <div class="container-fluid">
                @foreach($services as $service)
                <div class="row service-row">
                    <div class="col-3 col-md-1">
                       
                        <img src="./storage/images/service-images/{{ $service->service_image }}" width="200" height="70" class="rounded-circle">
                    </div>
                    <div class="col-9 col-md-7">
                        <h4>{{ $service->title }}</h4>
                        <p>{{ $service->description }}</p>
                    </div>
                    <div class="col-12 col-md-2">
                         <a class="btn btn-primary" href="{{ route('editVendorService', $service) }}"> Update 
                        </a>
                    </div>
                    <div class="col-12 col-md-2">
                        <a class="btn btn-danger" href="{{ route('deleteVendorService', $service )}}">
                          Delete
                       </a>
                    </div>
                </div>
                <hr>
                @endforeach
            </div>
        </section>
    </div>
@endsection
