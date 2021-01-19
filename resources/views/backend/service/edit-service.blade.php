@extends('backend.layout.app')
@section('content')
@section('custom-styles')
    <style type="text/css">
    .errors { color: red; display: inline;}
    </style>
@endsection
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Update Service</h1>
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
                <section id="content">
                    <div class="container" style="width: 70%;">
                        <form method="post" action="{{ route('updateSahulatService', ['id'=>$service->id]) }}" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Service Title</label> @error('title') <p class="errors"> {{ $message }} </p> @enderror
                                <input name="title" value="{{ $service->title }}" type="text" class="form-control" placeholder="Service Title">
                            </div>
                            <div class="form-group">
                                <label>Frequency</label> @error('frequency') <p class="errors"> {{ $message }} @enderror
                                <input name="frequency" value="{{ $service->frequency }}" type="text" class="form-control" placeholder="1, 30, 180, 360">
                            </div>
                            <div class="form-group">
                                <label>Service Charges ($)</label> @error('charges') <p class="errors"> {{ $message }} @enderror
                                <input name="charges" value="{{ $service->charges }}" type="text" class="form-control"  placeholder="Service Charges $">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-common">Add Service image</button>
                                <input name="service_image" type="file"> @error('service_image') <p class="errors"> {{ $message }} @enderror
                            </div>
                            <div class="form-group">
                                <label>Description</label> @error('description') <p class="errors"> {{ $message }} @enderror
                                <textarea name="description" class="form-control" rows="5">{{ $service->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Requirements</label> @error('requirements') <p class="errors"> {{ $message }} @enderror
                                <input name="requirements" value="{{ $service->requirements }}" type="text" class="form-control"  placeholder="e.g. CNIC, Passport etc">
                            </div>
                            @csrf
                            <div class="form-group">
                                <input name="submit" class="btn btn-primary" type="submit" value="Update Service" style="width: 100%;">
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </section>
    </div>
@endsection
