@extends('frontend.layouts.app')

@section('title')
  SAHULAT | Subscriptions
@endsection

@section('custom-styles')
  <style type="text/css">
    .subscribe-button{ background: green !important; }
  </style>
@endsection()

@section('content')

      <!-- Page Header Start -->
      <div class="page-header" style="background: url({{ asset('assets/img/banner1.jpg') }})">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="breadcrumb-wrapper">
                <h2 class="product-title">Subscriptions</h2>
                <ol class="breadcrumb">
                  <li><a href="#"><i class="ti-home"></i> Home</a></li>
                  <li class="current">Subscriptions</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Page Header End -->

      <!-- Start Content -->
      <div id="content">
        <div class="container">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="job-alerts-item">
                <h3 class="alerts-title">Choose Services For Subscription</h3>

                <div class="applications-content">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="thums">
                        <img src="assets/img/jobs/img-1.jpg" alt="">
                      </div>
                      <h3>Car Wash Service</h3>
                      <span>Hire a worker for your vehicle service</span>
                    </div>
                    <div class="col-md-2">
                      <p>Charges: $50</p>
                    </div>
                    <div class="col-md-2">
                      <p>Available</p>
                    </div>
                    <div class="col-md-1">
                      <a href="{{ route('subscribeAService') }}"><p><span class="full-time subscribe-button">Subscribe  </span></p></a>
                    </div>
                  </div>
                </div>
                <div class="applications-content">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="thums">
                        <img src="assets/img/jobs/img-1.jpg" alt="">
                      </div>
                      <h3>Car Wash Service</h3>
                      <span>Hire a worker for your vehicle service</span>
                    </div>
                    <div class="col-md-2">
                      <p>Charges: $50</p>
                    </div>
                    <div class="col-md-2">
                      <p>Available</p>
                    </div>
                    <div class="col-md-1">
                      <a href="{{ route('subscribeAService') }}"><p><span class="full-time subscribe-button">Subscribe  </span></p></a>
                    </div>
                  </div>
                </div>
                <div class="applications-content">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="thums">
                        <img src="assets/img/jobs/img-1.jpg" alt="">
                      </div>
                      <h3>Car Wash Service</h3>
                      <span>Hire a worker for your vehicle service</span>
                    </div>
                    <div class="col-md-2">
                      <p>Charges: $50</p>
                    </div>
                    <div class="col-md-2">
                      <p>Available</p>
                    </div>
                    <div class="col-md-1">
                      <a href="{{ route('subscribeAService') }}"><p><span class="full-time subscribe-button">Subscribe  </span></p></a>
                    </div>
                  </div>
                </div>

                <!-- Start Pagination -->

                <!-- End Pagination -->
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- End Content -->
@endsection
