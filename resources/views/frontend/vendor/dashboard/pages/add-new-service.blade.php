
@extends('frontend.vendor.dashboard.layout.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Add New Service</h1>
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
                <section id="content">
                    <div class="container" style="width: 70%;">

                        <form method="post" action="{{ route('storeService') }}" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="vendor_id"
                             value="{{Auth::user()->vendor->id}}">

                            <div class="form-group">
                                <label>Service Title</label>
                                <input name="title" type="text"
                                 class="form-control @error('title') is-invalid @enderror"  value="{{ old('title', $service->title ) }}"
                                 placeholder="Service Title">

                                   @error('title')
                                      <span class="invalid-feedback text-danger" role="alert">
                                          <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                            </div>
                            
                            <div class="form-group">
                                <label>Service Charges ($)</label>
                                <input name="charges" type="text" class="form-control  @error('charges') is-invalid @enderror" value="{{ old('charges', $service->charges ) }}"  placeholder="Service Charges $">

                                  @error('charges')
                                      <span class="invalid-feedback text-danger" role="alert">
                                          <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror


                            </div>
                            <div class="form-group">
                                <button class="btn btn-common">Add Service image</button>
                                <input name="service_image" type="file">
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description" class="form-control @error('description') is-invalid @enderror" 
                                value="{{ old('description', $service->description ) }}"  
                                 rows="5"></textarea>
                                  @error('description')
                                      <span class="invalid-feedback text-danger" role="alert">
                                          <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                            </div>
                            <div class="form-group">
                                <label>Requirements</label>
                                <input name="requirements" type="text" class="form-control"  placeholder="e.g. CNIC, Passport etc">
                            </div>

                            <div class="form-group">
                                <input name="submit" class="btn btn-primary" type="submit" value="Add Service" style="width: 100%;">
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </section>
    </div>
@endsection
