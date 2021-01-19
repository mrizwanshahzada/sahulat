@extends('backend.layout.app')
@section('custom-styles')
    <style type="text/css">
        .employee-details{ width: 50%; }
        .col-6 { text-align: left; }
        .update-button, input { width: 100% }
    </style>
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Update Employee Information</h1>
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
                <center>
                    <form method="post" action="{{ route('updateEmployeeSalary') }}">
                        @csrf
                        <div class="row employee-details">
                            <div class="col-6">
                              <img src="../storage/images/user-profile-images/{{ $employee->user->profile_photo }}" width="150" height="150">    
                            </div>
                        </div>
                        <input type="hidden" name="employee_id" value="{{ $employee->id }}">
                        <div class="row employee-details">
                            <div class="col-6">
                                <h4>Name</h4>
                            </div>
                            <div class="col-6">
                                <h4>{{ $employee->user->name }}</h4>
                            </div>
                        </div>
                        <div class="row employee-details">
                            <div class="col-6">
                                <h4>Phone</h4>    
                            </div>
                            <div class="col-6">
                                {{ $employee->user->phone }}
                            </div>
                        </div>
                        <div class="row employee-details">
                            <div class="col-6">
                                <h4>Address</h4>  
                            </div>
                            <div class="col-6">
                                {{ $employee->user->address }}
                            </div>
                        </div>
                        <div class="row employee-details">
                            <div class="col-6">
                                <h4>Email</h4>
                            </div>
                            <div class="col-6">
                                {{ $employee->user->email }}
                            </div>
                        </div>
                        <div class="row employee-details">
                            <div class="col-6">
                                <h4>Rating</h4> 
                            </div>
                            <div class="col-6">
                                {{ $employee->rating }}
                            </div>
                        </div>
                        <div class="row employee-details">
                            <div class="col-6">
                                <h4>Salary</h4>
                            </div>
                            <div class="col-6">
                                <input type="text" name="salary" value="{{ $employee->salary }}">
                            </div>
                        </div>
                        <div class="row employee-details">
                            <div class="col-6">
                                <h4>Status</h4>
                            </div>
                            <div class="col-6">
                                {{ $employee->status }}
                            </div>
                        </div>
                        <div class="row employee-details">
                            <div class="col-12">
                                <input type="submit" class="btn btn-primary update-button" value="Update">
                            </div>
                        </div>
                    </form>
                </center>
            </div>
        </section>
    </div>
@endsection
