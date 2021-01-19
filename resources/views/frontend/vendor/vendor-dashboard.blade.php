@extends('frontend.layouts.app')
@section('title')
SAHULAT | Vendor Dashboard
@endsection
@section('custom-styles')
<style type="text/css">
   h3 { font-size:1.5vw; }
   .chat-link{
   color: green; font-size: 120%;
   }
</style>
@endsection
@section('content')
<!-- Page Header Start -->
<div class="page-header" style="background: url({{ asset('assets/img/banner1.jpg') }})">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="breadcrumb-wrapper">
               <h2 class="product-title">Vendor Dashboard</h2>
               <ol class="breadcrumb">
                  <li><a href="#"><i class="ti-home"></i> Home</a></li>
                  <li class="current">Vendor Dashboard</li>
               </ol>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- Page Header End -->
<!-- Start Content -->
<div id="content">
   <div class="container applications-content">
      <div class="row">
         <div class="col-md-1 col-sm-1 col-xs-2">
            <div class="thums">
               <img src="assets/img/car-wash.jpg" class="img-circle" style="width: 70px; height: 70px; padding-top: 15%">
            </div>
         </div>
         <div class="col-md-2 col-sm-2 col-xs-4">
            <h3>Car Wash</h3>
            <span>Get your vehicle washed</span>
            <br>
            <a>&nbsp</a>
         </div>
         <div class="col-md-1 col-sm-1 col-xs-2">
            <div class="thums">
               <img src="assets/img/testimonial/img1.jpg" class="img-circle" style="width: 70px; height: 70px; padding-top: 15%">
            </div>
         </div>
         <div class="col-md-2 col-sm-2 col-xs-4">
            <h3>Customer</h3>
            <span>Mrs Donna</span>
            <br>
            <a href="chat" class="chat-link">Chat</a>
         </div>
         <div class="col-md-2 col-sm-2 col-xs-12">
            <h3>Deadline</h3>
            <span>10/10/2020</span>
         </div>
         <div class="col-md-1 col-sm-1 col-xs-12">
            <span>
               <h3>Budget</h3>
               <span>$50</span>
            </span>
         </div>
         <div class="col-md-1 col-sm-1 col-xs-12">
            <span>
               <h3>Status</h3>
               <span>Pending</span>
            </span>
         </div>
         <div class="col-md-2 col-sm-2 col-xs-12">
            <a href="{{ route('updateTask') }}" class="btn btn-primary btn-block" style="float: right; text-align: center;">Update</a>
         </div>
      </div>
   </div>
   <div class="container applications-content">
      <div class="row">
         <div class="col-md-1 col-sm-1 col-xs-2">
            <div class="thums">
               <img src="assets/img/car-wash.jpg" class="img-circle" style="width: 70px; height: 70px; padding-top: 15%">
            </div>
         </div>
         <div class="col-md-2 col-sm-2 col-xs-4">
            <h3>Car Wash</h3>
            <span>Get your vehicle washed</span>
            <br>
            <a>&nbsp</a>
         </div>
         <div class="col-md-1 col-sm-1 col-xs-2">
            <div class="thums">
               <img src="assets/img/testimonial/img1.jpg" class="img-circle" style="width: 70px; height: 70px; padding-top: 15%">
            </div>
         </div>
         <div class="col-md-2 col-sm-2 col-xs-4">
            <h3>Customer</h3>
            <span>Mrs Donna</span>
            <br>
            <a href="#" class="chat-link">Chat</a>
         </div>
         <div class="col-md-2 col-sm-2 col-xs-12">
            <h3>Deadline</h3>
            <span>10/10/2020</span>
         </div>
         <div class="col-md-1 col-sm-1 col-xs-12">
            <span>
               <h3>Budget</h3>
               <span>$50</span>
            </span>
         </div>
         <div class="col-md-1 col-sm-1 col-xs-12">
            <span>
               <h3>Status</h3>
               <span>Pending</span>
            </span>
         </div>
         <div class="col-md-2 col-sm-2 col-xs-12">
            <a href="{{ route('updateTask') }}" class="btn btn-primary btn-block" style="float: right; text-align: center;">Update</a>
         </div>
      </div>
   </div>
   <div class="container applications-content">
      <div class="row">
         <div class="col-md-1 col-sm-1 col-xs-2">
            <div class="thums">
               <img src="assets/img/car-wash.jpg" class="img-circle" style="width: 70px; height: 70px; padding-top: 15%">
            </div>
         </div>
         <div class="col-md-2 col-sm-2 col-xs-4">
            <h3>Car Wash</h3>
            <span>Get your vehicle washed</span>
            <br>
            <a>&nbsp</a>
         </div>
         <div class="col-md-1 col-sm-1 col-xs-2">
            <div class="thums">
               <img src="assets/img/testimonial/img1.jpg" class="img-circle" style="width: 70px; height: 70px; padding-top: 15%">
            </div>
         </div>
         <div class="col-md-2 col-sm-2 col-xs-4">
            <h3>Customer</h3>
            <span>Mrs Donna</span>
            <br>
            <a href="#" class="chat-link">Chat</a>
         </div>
         <div class="col-md-2 col-sm-2 col-xs-12">
            <h3>Deadline</h3>
            <span>10/10/2020</span>
         </div>
         <div class="col-md-1 col-sm-1 col-xs-12">
            <span>
               <h3>Budget</h3>
               <span>$50</span>
            </span>
         </div>
         <div class="col-md-1 col-sm-1 col-xs-12">
            <span>
               <h3>Status</h3>
               <span>Pending</span>
            </span>
         </div>
         <div class="col-md-2 col-sm-2 col-xs-12">
            <a href="{{ route('updateTask') }}" class="btn btn-primary btn-block" style="float: right; text-align: center;">Update</a>
         </div>
      </div>
   </div>
   <!-- Start Pagination -->
   <br>
   <ul class="pagination">
      <li class="active"><a href="#" class="btn btn-common" ><i class="ti-angle-left"></i> prev</a></li>
      <li><a href="#">1</a></li>
      <li><a href="#">2</a></li>
      <li><a href="#">3</a></li>
      <li><a href="#">4</a></li>
      <li><a href="#">5</a></li>
      <li class="active"><a href="#" class="btn btn-common">Next <i class="ti-angle-right"></i></a></li>
   </ul>
   <!-- End Pagination -->
</div>
<!-- End Content -->
@endsection
