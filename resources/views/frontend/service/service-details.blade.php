@extends('frontend.layouts.app')

@section('title')
    SAHULAT | Service details
@endsection

@section('custom-styles')
    <style>
        .btn-right { float: right; margin: 1%;}
    </style>
@endsection

@section('content')


 <!-- Page Header Start -->
      <div class="page-header" style="background: url({{ asset('assets/img/banner1.jpg') }})">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="breadcrumb-wrapper">
                <h2 class="product-title">Service Details</h2>
                <ol class="breadcrumb">
                  <li><a href="#"><i class="ti-home"></i> Home</a></li>
                  <li class="current">Service Details</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Page Header End -->


   <!-- Job Detail Section Start -->
      <section class="job-detail section">
        <div class="container">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="header-detail">
                  <div class="header-content pull-left">
                    <h3><a href="#">{{$service->title}}</a></h3>
                    <!-- <p><span>Date Posted: Feb 20, 2018</span></p> -->
                    <p>Estimate Task Budget: <strong class="price">
                      {{$service->charges}}</strong></p>
                  </div>
                  <div class="detail-company pull-right text-right">
                    <div class="img-thum">
                      <img class="img-responsive" src="assets/img/jobs/recent-job-detail.jpg" alt="">
                    </div>
                    <div class="name">
                      <h4>City Lahore</h4>
                      <h5>Pakistan, Lahore </h5>
                    </div>
                  </div>
                      <div class="clearfix">
                        <a href="{{route('userBuyServiceForm',$service)}}" class="btn btn-common">Buy</a>
                        @if($service->frequency != Null)
                              <a href="{{route('subscribeAService',$service->id)}}" class="btn btn-common">Subscribe</a>
                          @endif
                      </div>
                </div>
              </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="content-area">
                <div class="clearfix">
                <div class="box">
                    <h4>Service Description</h4>
                    <p>
                      {{$service->description}}
                    </p>
                    <h4>Requirements</h4>
                    <ul>
                      @foreach(explode(',', $service->requirements) as $requirement)
                    <li>
                      {{$requirement}}
                  </li>
                  @endforeach
                    </ul>
                    <!-- <a href="#" class="btn btn-common">Get this service now</a> -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- Job Detail Section End -->
@endsection
