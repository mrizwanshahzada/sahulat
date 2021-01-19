
@extends('frontend.layouts.app')

@section('title')
  SAHULAT | Service details
@endsection

@section('content')






<section class="job-detail section">
        <div class="container">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="header-detail">
                  <div class="header-content pull-left">
                    <h3><a href="#">{{$service->title}}</a></h3>

                     <p>Estimate Task Budget: <strong class="price">
                      {{$service->charges}}

                    </strong></p>
                  </div>
                  <div class="detail-company pull-right text-right">
                    <div class="img-thum">
                      <img class="img-responsive" src="assets/img/jobs/recent-job-detail.jpg" alt="">
                    </div>
                    <div class="name">
                      <h4>Pakistan</h4>
                      <h5>{{$service->vendor->business_location}} </h5>
                      <p>{{$service->vendor->company_name}}</p>

                      <br>
                      <a href="{{route('initializeTask' , [$service->vendor->id , $service->id , $service->charges])}}"
                       class="btn btn-common">Buy Service </a>


                    </div>
                  </div>

              </div>
            </div>
            <div class="col-md-8 col-sm-12 col-xs-12">
              <div class="content-area">
                <div class="clearfix">
                <div class="box">
                    <h4>Job Description</h4>
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



                  </div>
                </div>
              </div>


            </div>
            <div class="col-md-4 col-sm-12 col-xs-12">
            <aside>
              <div class="sidebar">
                  <div class="box">
                    <h2 class="small-title">Vendor Details</h2>
                    <ul class="detail-list">
                      <li>
                        <a href="#">Name</a>
                        <span class="type-posts">{{$service->vendor->user->name}}</span>
                      </li>
                      <li>
                        <a href="#">Location</a>
                        <span class="type-posts">{{$service->vendor->business_location}}</span>
                      </li>
                      @if($service->vendor->company_name !="")
                      <li>
                        <a href="#">Company</a>
                        <span class="type-posts">{{$service->vendor->company_name}}</span>
                      </li>
                      @endif
                      <li>
                        <a href="#">Rating</a>
                        <span class="type-posts">{{$service->vendor->rating}}</span>
                      </li>
                      <li>
                        <a href="#">Gender</a>
                        <span class="type-posts">{{$service->vendor->user->gender}}</span>
                      </li>

                    </ul>
                  </div>


                </div>
              </aside>
            </div>
          </div>
        </div>
      </section>



      @endsection
