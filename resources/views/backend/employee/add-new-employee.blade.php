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
                        <h1 class="m-0 text-dark">Add New Employee</h1>
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
                        <form method="post" action="{{ route('registerNewEmployee') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Employee Name</label> @error('name') <p class="errors"> {{ $message }} </p> @enderror
                                <input name="name" type="text" value="{{old('name')}}" class="form-control" placeholder="Employee Name" required>
                            </div>
                            <div class="form-group">
                                <label>Phone No</label> @error('phone') <p class="errors"> {{ $message }} </p> @enderror
                                <input name="phone" type="text" value="{{old('phone')}}" class="form-control" placeholder="Phone No" required>
                            </div>
                            <div class="form-group">
                                <label>Address</label> @error('address') <p class="errors"> {{ $message }} </p> @enderror
                                <input name="address" type="text" value="{{old('address')}}" class="form-control"  placeholder="Address" required>
                            </div>

                            <div class="form-group">
                                <label>Gender</label> 
                                <select id="inputState" name="gender" class="form-control" required>
                                    <option>Male</option>
                                    <option>Female</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Salary (Rs/Month)</label> @error('salary') <p class="errors"> {{ $message }} </p> @enderror
                                <input name="salary" type="text" value="{{old('salary')}}" class="form-control"  placeholder="Salary in Rs" required>
                            </div>
                            <div class="form-group">
                                <label>Email</label> @error('email') <p class="errors"> {{ $message }} </p> @enderror
                                <input name="email" type="email" value="{{old('email')}}" class="form-control"  placeholder="Email" required>
                            </div>

                            <div class="form-group">
                                <input name="submit" class="btn btn-primary" type="submit" value="Add Employee" style="width: 100%;">
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </section>
    </div>
@endsection
