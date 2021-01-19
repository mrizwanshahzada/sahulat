@extends('frontend.layouts.app')

@section('title')
  SAHULAT | About
@endsection

@section("content")


  <section class="page-header" style="background: url({{ asset('assets/img/banner1.jpg') }})">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="breadcrumb-wrapper">
                <h2 class="product-title">About Us</h2>
                <ol class="breadcrumb">
                  <li><i class="ti-home"></i> Home</li>
                  <li class="current">About Us</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
      </section>


 <section class="about section">
        <div class="container">
          <div class="row">
            <div class="col-md-6 col-sm-12">
              <img src="assets/img/about/img1.jpg" alt="">
            </div>
            <div class="col-md-6 col-sm-12">
              <div class="about-content">
                <h2 class="medium-title">Sahulat</h2>
                <p class="desc">SAHULAT is an online portal that provides assistance and support to public in performing their tasks with 100 percent guaranteed satisfaction.Quality is our major concern in completing all/any tasks for our customers who are our most trustworthy and important assets. We also have alliance agreements to work with reliable courier and task services where we need to engage some local help. We also provides a platform for vendors where they can search their customer and earn money by doing their work. It’s available in Lahore and all the services will be offered for Lahore only.</p>
                <a href="#" class="btn btn-common">Learn More</a>
              </div>
            </div>
          </div>
        </div>
      </section>
@endsection





