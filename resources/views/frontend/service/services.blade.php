@extends('frontend.layouts.app')
@section('title')
    SAHULAT | Services
@endsection
@section('custom-styles')
    <style type="text/css">
        .btn-buy{
            width: 100%;
        }
        .buffer{
            height: 10vh;
        }
        .services-row {
            padding: 2%;
        }
    </style>
@endsection
@section("content")
    {{-- our services  --}}
    <section class="find-job section">
        <div class="container">
            <h2 class="section-title text-danger ">Sahulat Services</h2>


            @foreach($sahulatServices as $service)
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


            {{-- {{ $services->links() }} --}}

            <div class="co-md-12 buffer"></div>


        </div>
    </section>
    {{-- vendor services --}}
    <section class="find-job section">
        <div class="container">
            <h2 class="section-title text-success text-dange">Vendor Services</h2>


            @foreach($vendorServices as $service)
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


            {{-- {{ $services->links() }} --}}

            <div class="buffer"></div>


        </div>
    </section>

@endsection
