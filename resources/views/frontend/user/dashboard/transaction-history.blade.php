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
                        <h1 class="m-0 text-dark">My Transactions History</h1>
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
                        <th scope="col">Amount</th>
                        <th scope="col">Transaction Date</th>
                        <th scope="col">Transaction Type</th>
                        <th scope="col">Description</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($payments as $payment)
                        <tr>
                          <td>Rs {{ $payment->amount }}</td>
                          <td>{{ $payment->created_at->format('d M y h:m a') }}</td>
                          <td>
                            @if($payment->subscription_id != NULL)
                            Subscription
                            @else
                            One Time Service
                            @endif
                          </td>
                          <td>This transaction is against
                            @if($payment->subscription_id != NULL)
                             subscription for {{ $payment->subscription->service->title }} service
                            @else
                             {{ $payment->task->service->title }} service
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
