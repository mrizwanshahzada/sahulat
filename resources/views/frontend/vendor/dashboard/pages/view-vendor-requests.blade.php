
@extends('frontend.vendor.dashboard.layout.app')

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
                        <h1 class="m-0 text-dark">Services</h1>
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
                @foreach($data['vendors'] as $vendor)
                    <div class="row service-row">

                        <div class="col-md-1">
                            <img src="storage/images/user-profile-images/{{ $vendor->user->profile_photo }}" width="200" height="70" class="rounded-circle">
                        </div>
                        <div class="col-md-3">
                            <h4>{{ $vendor->user->name }}</h4>
                            <p>{{ $vendor->company_name }}</p>
                        </div>
                        <div class="col-md-3">
                            <h4>Offering</h4>
                            <p>{{ $data['services']->find($vendor->id)->title }}</p>
                            <a href="{{ route('serviceDetails', $data['services']->find($vendor->id)) }}">See Service Details</a>
                        </div>
                        <div class="col-md-3">
                            <h5>Business Location</h5>
                            <p>{{ $vendor->business_location }}</p>
                            <a href="{{ route('verifyVendor', $vendor->id) }}">Verify</a>
                        </div>
                        <div class="col-md-2">
                            <a href="{{ route('approveVendor', $vendor->id) }}" class="btn btn-primary">Approve</a>
                            <a href="{{ route('cancelVendorRequest', $vendor->id) }}" class="btn btn-danger">Cancel</a>
                        </div>
{{--                        <div class="col-12 col-md-2">--}}
{{--                            <a class="btn btn-primary" href="{{ route('editService', ['service'=>$service]) }}">Update</a>--}}
{{--                        </div>--}}
{{--                        <div class="col-12 col-md-2">--}}
{{--                            <a class="btn btn-danger" href="{{ route('deleteService', ['id'=>$service->id]) }}">Delete</a>--}}
{{--                        </div>--}}
                    </div>
                    <hr>
                @endforeach
            </div>
        </section>
    </div>
@endsection
