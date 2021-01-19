
@extends('backend.layout.app')
@section('custom-styles')
    <style>
        .small-box{ height: 150px;}
    </style>
@endsection
@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
              <a href="{{ route('addNewService') }}">
                <div class="small-box bg-info">
                  <div class="inner">
                    <h4>Add New Service</h4>
                    <p>Offer a new service for your customers</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-bag"></i>
                  </div>
                </div>
              </a>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
              <a href="{{ route('viewServices', 'Sahulat') }}">
                <div class="small-box bg-success">
                  <div class="inner">
                    <h4>Update Services</h4>
                    <p>Edit or Delete your offered services</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-android-create"></i>
                  </div>
                </div>
              </a>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
              <a href="{{ route('viewVendorRequests') }}">
                <div class="small-box bg-warning">
                  <div class="inner">
                    <h4>Approve Vendors</h4>
                    <p>Pending Requests ({{ $vendor_requests }})</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-person-add"></i>
                  </div>
                </div>
              </a>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
              <a href="{{ route('addNewEmployee') }}">
                <div class="small-box bg-maroon">
                  <div class="inner">
                    <h4>Add Employee</h4>
                    <p>Add a new employee</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-person-add"></i>
                  </div>
                </div>
              </a>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->


  </div>

  @endsection
