@extends('frontend.layouts.app')
@section('title')
    SAHULAT | Search Result
@endsection
@section('custom-styles')
    <style>
        .page-header { padding: 1%; }
        .search-container { padding-top: 0; margin-top: 1%;}
        .search-row { width: 80%; margin: 1% auto 1% auto; padding: 1%; background: #f5f3f3}
        .sahulat_service { background: #f5f2d0 }
        .btn-info{ width: 100%; background: #FF4F57;}
        p { padding: 0; margin: 0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-height: 10ch; }
        .profile-col { padding: 0; }
        .service-col { padding: 2% 2% 2% 0;}
        .hire-col { padding: 2%;}

        #ex1RangePicker .rangepicker-selection {
            background: #BABABA;
        }
    </style>

{{--    Search Radius Styles--}}
    <style>
        .range { width: 30%; margin: auto; }
        .range-title { padding: 2%; font-size: 80%;}
        .range-selector { display: inline; }
        .range-value { display: inline; }
        .slidecontainer {
            width: 100%; /* Width of the outside container */
        }

        /* The slider itself */
        .slider {
            -webkit-appearance: none;  /* Override default CSS styles */
            appearance: none;
            width: 100%; /* Full-width */
            height: 25px; /* Specified height */
            background: #d3d3d3; /* Grey background */
            outline: none; /* Remove outline */
            opacity: 0.7; /* Set transparency (for mouse-over effects on hover) */
            -webkit-transition: .2s; /* 0.2 seconds transition on hover */
            transition: opacity .2s;
        }

        /* Mouse-over effects */
        .slider:hover {
            opacity: 1; /* Fully shown on mouse-over */
        }

        /* The slider handle (use -webkit- (Chrome, Opera, Safari, Edge) and -moz- (Firefox) to override default look) */
        .slider::-webkit-slider-thumb {
            -webkit-appearance: none; /* Override default look */
            appearance: none;
            width: 25px; /* Set a specific slider handle width */
            height: 25px; /* Slider handle height */
            background: #FF4F57; /* Green background */
            cursor: pointer; /* Cursor on hover */
        }

        .slider::-moz-range-thumb {
            width: 25px; /* Set a specific slider handle width */
            height: 25px; /* Slider handle height */
            background: #4CAF50; /* Green background */
            cursor: pointer; /* Cursor on hover */
        }
    </style>

@endsection
@section("content")


    <section class="page-header" style="background: url({{ asset('assets/img/banner1.jpg') }})">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb-wrapper">
                        <h2 class="product-title">Search Result</h2>
                        <ol class="breadcrumb">
                            <li><a href="#"><i class="ti-home"></i> Home</a></li>
                            <li class="current">Search Result</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>

{{--    Search Radious--}}
    <div class="range">
        <div class="slidecontainer">
            <h6 class="range-title" align="center">Please Select the Range in Which You Want to Find A Vendor</h6>
            <input type="range" min="1" max="10" value="10" class="slider range-selector" id="myRange">
            <strong><h5 id="range-value" class="range-value" align="center"></h5></strong> KM
        </div>
    </div>
{{--    End of Search Radius--}}

    <div class="container search-container" id="search-content">

        @if(count($data['sahulatServices']) > 0 || count($data['vendorsServices']) > 0)
            <!-- Vendor Services -->
                @foreach($data['vendorsServices'] as $service)
                    <div class="row search-row">
                        <div class="col-md-2 col-sm-2 col-2 profile-col">
                            <img src="../storage/images/user-profile-images/{{ $service->vendor->user->profile_photo }}" width="70" height="70" class="img-circle center-block">
                            <p class="center"><strong>{{ $service->vendor->user->name }}</strong></p>
                            <p class="small center"><strong><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></strong></p>
                        </div>
                        <div class="col-md-5 col-sm-5 col-5 service-col">
                            <a href="{{ route('serviceDetails', $service->id) }}">
                                <h4>{{ $service->title }}</h4>
                                <p>{{ $service->description }}</p>
                            </a>
                        </div>
                        <div class="col-md-2 col-sm-2 col-2 service-col">
                            <h5>Business Location</h5>
                            <p>{{ $service->vendor->business_location }}</p>
                        </div>
                        <div class="col-md-1 col-sm-1 col-1 service-col">
                            <h4>Charges</h4>
                            <h4>Rs {{ $service->charges }}</h4>
                        </div>
                        <div class="col-md-2 col-sm-2 col-2 hire-col">
                            <a href="{{route('serviceDetails',$service->id)}}" class="btn btn-info">Hire</a>
                        </div>
                    </div>
                @endforeach

            <!-- Sahulat Services -->
            @foreach($data['sahulatServices'] as $service)
                <div class="row search-row sahulat_service">
                    <div class="col-md-2 col-sm-2 col-2 profile-col">
                        <img src="../storage/images/service-images/{{ $service->service_image }}" width="70" height="70" class="img-circle center-block">
                        <p class="center"><strong>SAHULAT</strong></p>
                    </div>
                    <div class="col-md-5 col-sm-5 col-5 service-col">
                        <a href="{{ route('serviceDetails', $service->id) }}">
                            <h4>{{ $service->title }}</h4>
                            <p>{{ $service->description }}</p>
                        </a>
                    </div>
                    <div class="col-md-2 col-sm-2 col-2 service-col">
                        <h5>Business Location</h5>
                        <p>Lahore</p>
                    </div>
                    <div class="col-md-1 col-sm-1 col-1 service-col">
                        <h4>Charges</h4>
                        <h4>Rs {{ $service->charges }}</h4>
                    </div>
                    <div class="col-md-2 col-sm-2 col-2 hire-col">
                        <a href="{{route('serviceDetails',$service->id)}}" class="btn btn-info">Buy</a>
                    </div>
                </div>
            @endforeach


        @else
            <div class="container search-container">
                <h1 align="center">No Results Found</h1>
            </div>

        @endif
    </div>

@endsection
@section('custom-scripts')
    <script>
        let lat, lng;

        getLocation();
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                alert('Unable to get location');
            }
        }

        function showPosition(position) {
            lat = position.coords.latitude;
            lng = position.coords.longitude;
        }


        $('#range-value').html($('#myRange').val()); // Display the default slider value
        // Update the current slider value (each time you drag the slider handle)
        $('#myRange').on('input', function() {
            $('#range-value').html(this.value);
            $.post(
                '{{ route("fetchNearbyVendors") }}',
                {
                    keywords: '{{ $data['keywords'] }}',
                    distance: $('#myRange').val(),
                    latitude: lat,
                    longitude: lng,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                function (e) {
                    console.log('success');
                    $('#search-content').html(e);
                }
            );
        });


    </script>
    @endsection





