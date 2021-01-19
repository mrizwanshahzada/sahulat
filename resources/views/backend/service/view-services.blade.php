@extends('backend.layout.app')
@section('custom-styles')
    <style type="text/css">
        .service-row{ width: 90%; margin: auto; }
        .col-md-2 { align-items: center; display: flex;}
        .btn-primary, .btn-danger{ width: 100%;}
        .service-link { color: black; }
        img { width: 100%; }
        p { padding: 0; margin: 0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-height: 10ch; }
    </style>
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-6">
                        <h1 class="m-0 text-dark">{{ $data['type'] }} Services</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-6">
                        <ol class="breadcrumb float-right">
                            <li class="nav-item"><a href="{{ route('addNewService') }}" class="btn btn-primary">Add New Service</a> </li>
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
                @foreach($data['services'] as $service)
                <div class="row service-row">
                    <div class="col-3 col-md-2">
                        <img src="../storage/images/service-images/{{ $service->service_image }}" class="rounded" width="70" height="70">
                    </div>
                    <div class="col-9 col-md-6">
                        <a href="{{ route('serviceDetails', $service->id) }}" class="service-link">
                            <h4>{{ $service->title }}</h4>
                            <p>{{ $service->description }}</p>                            
                        </a>
                    </div>
                    <div class="col-12 col-md-2">
                    @if($service->vendor == Null)
                        <a class="btn btn-primary" href="{{ route('editService', ['service'=>$service]) }}">Update</a>
                    @endif
                    </div>
                    <div class="col-12 col-md-2">
                        <a class="btn btn-danger" href="{{ route('removeSahulatService', ['id'=>$service->id]) }}">Delete</a>
                    </div>
                </div>
                <hr>
                @endforeach
            </div>
        </section>
    </div>
@endsection
