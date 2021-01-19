@extends('frontend.user.layouts.app')
@section('custom-styles')
    {{--
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
    --}}

@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">My Subscriptions</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Customer Dashboard</li>
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
        <div id="content">
            <div class="container applications-content">
                <section style="background: #dc3545; color: white;">
                </section>
                <table class="table table-bordered">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">Service Name</th>
                        <th scope="col">Service Frequency</th>
                        <th scope="col">Start Date</th>
                        <th scope="col">Renewal Date</th>
                        <th scope="col">Expiry</th>
                        <th scope="col">Budget</th>
                        <th scope="col">Status</th>
                        <th scope="col" class="text-center">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($subscriptions as $subscription)
                        <tr>
                          <td>{{$subscription->service->title}}</td>
                          <td>{{$subscription->frequency}} Days</td>
                          <td>{{$subscription->created_at->format('d M Y')}}</td>
                          <td>
                              @if($subscription->renew_date == NULL)
                                  N/A
                                  @else
                                  {{\Carbon\Carbon::parse($subscription->renew_date)->format('d M Y')}}
                              @endif
                          </td>
                          <td>{{\Carbon\Carbon::parse($subscription->expiry)->format('d M Y')}}</td>
                          <td>{{$subscription->charges}}</td>
                          <td>{{$subscription->status}}</td>
                          <td>
                            @if($subscription->status != 'Active')
                                <span class="badge badge-danger">{{$subscription->status}}</span>
                            @else
                                <a href="{{route('deleteSubs',$subscription->id)}}" class="btn btn-danger btn-sm">Cancel</a>
                            @endif
                          </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <section class="content">

        </section>
        <!-- /.content -->
    </div>
@endsection
