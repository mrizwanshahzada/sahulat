@extends('frontend.layouts.app')

@section('title')
    SAHULAT | Home
@endsection

@section('custom-styles')

    <style type="text/css">

        html,body{
            height: 100%;
            width: 100%;
            background: url(../img/bg.jpg) no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            font-family: 'Source Sans Pro', sans-serif;
            /*font-size: 5px;*/
        }
        h1{
            font-size: 3rem;
            /*color: #a53817;*/
            text-shadow: 5px 4px #a53817;
        }

        .btn-buy{
            font-weight: 700;
            border-radius: 200px;
            text-transform: uppercase;
        }
        .btn-buy{
            background-color: #121417;
            border-color: #121417;
            padding: 1rem 3rem;

        }
        .btn-buy:hover{
            background-color: red;
            border-color: #a53817;
            border:20rem;
        }
        .buffer{
            height: 1rem;
        }


        .card{
            /*color: #999;*/

            margin-top: 50px;
            margin-left: 35%;
            height: 100vh;
            padding: 30px;
            background-color: #824040 ;
            opacity: 0.80;
            border-radius: 3px;
            margin-bottom: 15px;
            box-shadow: 0px 2px 2px rgba(0 ,0, 0.3) ;
            /*transition: all 0.5s;*/
            padding: 30px 0;
            width: 390px;
            transition: all 0.2s;

        }
        .card:hover{

            /*transform: skewY(20deg);*/
            background-color: black;
            transform: scale(1.1);
        }
        .client-info{
            font-size: 1rem;
        }
        .space{
            height: 10vh;
        }
        .buy-service{
            width: 100%;
        }

        .services-row {
            padding: 2%;
        }
    </style>
@endsection

@section("content")

    {{--  <section id="intro" class="section-intro">

      <div class="search-container">
         <div class="container">
           <div class="row">
             <div class="col-md-12">
               <h1>Find the service you need</h1><br><h2>More than <strong>100</strong> services are available for you to make your life easier</h2>
               <div class="content">
                 <form method="get" name="myform" action="{{ route('search') }}" id="form">
                   <div class="row">
                     <div class="col-md-11 col-sm-6">
                       <div class="form-group">
                         <input class="form-control" type="text" placeholder="service title / keywords / company name" name="keywords" id="findSearchInput">
                         <i class="ti-time"></i>
                       </div>
                     </div>
                     <div class="col-md-1 col-sm-6">
                       <a href="javascript:submitform()">
                       <button type="submit" class="btn btn-search-icon" id="btnClick"><i class="ti-search"></i></button>
                     </a>
                     </div>
                   </div>
                 </form>
               </div>
               <div class="popular-jobs">
                 <b>Popular Keywords: </b>
                 <a href="#">VISA Services</a>
                 <a href="#">NADRA</a>
                 <a href="#">Court Assistance</a>
               </div>
             </div>
           </div>
         </div>
       </div>

      </section> --}}


    <!-- Testimonial Section Start -->
    <section id="testimonial" class="section">
        <div class="container">
            <div class="row">

                <div class="touch-slider" class="owl-carousel owl-theme">

                    @foreach($ourServices as $service)
                        <a href="{{route('serviceDetails',$service->id)}}">
                            <div class="card" style="width:35%;height:40%" >
                                <div class="item active text-center">
                                    <img class="img-member" src="../storage/images/service-images/{{$service->service_image}}" alt="">
                                    <div class="client-info">
                                        <h2 class="client-name">{{$service->title}} <span> charges <strong>({{$service->charges}})</strong></span></h2>
                                    </div>
                                    <p>
                                        <i class="fa fa-quote-left quote-left"></i>

                                        {{$service->description}}
                                        <i class="fa fa-quote-right quote-right"></i>
                                    </p>
                                    <div class="buffer col-12"></div>
                                    <div class="text-center col-lg-12">
                                        <a href="{{route('serviceDetails',$service->id)}}">
                                            <button class="btn btn-buy  btn-xl text-capitalize client-info">
                                                Buy service
                                            </button>
                                        </a>

                                    </div>


                                </div>
                            </div>
                        </a>
                    <!-- {{-- first slide end --}} -->

                    @endforeach()

                </div>

            </div>
        </div>
    </section>
    <!-- Testimonial Section End -->




    <!-- Main Services Section Start -->
    <section class="find-job section">
        <div class="container">
            <h2 class="section-title text-danger ">Vendor Services</h2>


            @foreach($services as $service)
                <div class="row services-row">
                    <div class="thumb col-md-2 col-sm-2">
                        <a href="{{route('serviceDetails',$service->id)}}">
                            <img src="../storage/images/service-images/{{$service->service_image}}" width="200" height="70"  class="img-fluid">
                        </a>
                    </div>
                    <div class="job-list-content col-md-8 col-sm-8">
                        <h4><a href="{{route('serviceDetails',$service->id)}}">{{$service->title}}</a></h4>
                        <p>{{$service->description}}</p>
                    </div>
                    <div class="pull-right col-md-2 col-sm-2 ">
                        <a href="{{route('serviceDetails',$service->id)}}" class="btn btn-common buy-service ">Buy Service</a>
                    </div>
                </div>
            @endforeach()




            <div class="co-md-12 space"></div>
            <div class="col-md-12 m-5">
                <ul class="pagination pull-right">

                    <li>{{ $services->links() }}</li>
                </ul>
            </div>

        </div>
    </section>
    <!-- Main Services Section End -->




    <!-- Start Purchase Section -->
    <section class="section purchase" data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row">
                <div class="section-content text-center">
                    <h1 class="title-text">
                        Looking for a Job?
                    </h1>
                    <p>If you are looking for job, you can offer your services on our portal. Join us as a vendor.</p>
                    <a href="{{route('registerVendor')}}" class="btn btn-common">Apply Now</a>
                </div>
            </div>
        </div>
    </section>
    <!-- End Purchase Section -->




    <!-- Featured Services Section Start -->
    <section class="featured-jobs section">
        <div class="container">
            <h2 class="section-title">
                Our top services
            </h2>
            <div class="row">
                @foreach($ourTopServices as $task)
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="featured-item">
                            <div class="featured-wrap">
                                <div class="featured-inner">
                                    <figure class="item-thumb">
                                        <a class="hover-effect" href="{{route('serviceDetails',$task->service->id)}}">
                                            <img src="../storage/images/service-images/{{$task->service->service_image}}" alt="">
                                        </a>
                                    </figure>
                                    <div class="item-body">
                                        <h3 class="job-title"><a href="{{route('serviceDetails',$task->service->id)}}">{{$task->service->title}}</a></h3>
                                        <div class="adderess">{{$task->service->charges}} </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item-foot">
                                <span><i class="ti-time"></i> 24 Hours </span>
                                <div class="view-iocn">
                                    <a href="{{route('serviceDetails',$task->service->id)}}"><i class="ti-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Featured Services Section End -->




    <!-- Testimonial Section Start -->
    <section id="testimonial" class="section">
        <div class="container">
            <div class="row">
                <div class="touch-slider" class="owl-carousel owl-theme">
                    @foreach($topVendors as $topVendor)
                        <div class="item active text-center">
                            <img class="img-member" src="../storage/images/user-profile-images/{{$topVendor->user->profile_photo}}" alt="">
                            <div class="client-info">
                                <h2 class="client-name">{{$topVendor->user->name}} </h2>
                            </div>
                            <div class="client-info"> <p class="client-name">Rating : {{$topVendor->rating}}</p></div>
                            @if($topVendor->company_name)
                                <p><i class="fa fa-quote-left quote-left"></i> Company Name :<span> {{$topVendor->company_name}}</span><i class="fa fa-quote-right quote-right"></i>
                                </p>
                            @else
                                <p><i class="fa fa-quote-left quote-left"></i> Company Name : <span>Vendor has no company</span><i class="fa fa-quote-right quote-right"></i>
                            @endif
                        </div>

                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- Testimonial Section End -->





    <!-- Clients Section -->
    <section class="clients section">
        <div class="container">

        </div>
    </section>
    <!-- Client Section End -->







    <!-- Achievements Section Start -->
    <section id="counter">
        <div class="container">
            <h2 class="section-title">
                Achievements
            </h2>
            <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="counting">
                        <div class="icon">
                            <i class="ti-briefcase"></i>
                        </div>
                        <div class="desc">
                            <h2>Completed Tasks</h2>
                            <h1 class="counter">{{count($tasks)}}</h1>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="counting">
                        <div class="icon">
                            <i class="ti-user"></i>
                        </div>
                        <div class="desc">
                            <h2>Customers</h2>
                            <h1 class="counter">{{count($users)}}</h1>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="counting">
                        <div class="icon">
                            <i class="ti-user"></i>
                        </div>
                        <div class="desc">
                            <h2>Vendors</h2>
                            <h1 class="counter">{{count($vendors)}}</h1>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="counting">
                        <div class="icon">
                            <i class="ti-heart"></i>
                        </div>
                        <div class="desc">
                            <h2>Companies</h2>
                            <h1 class="counter">{{count($vendorsCompanies)}}</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Achievements Section End -->

@endsection


