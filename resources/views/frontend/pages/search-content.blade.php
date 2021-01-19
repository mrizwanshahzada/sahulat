
@if(count($data['vendorsServices']) > 0)
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


@else
    <div class="container search-container">
        <h1 align="center">No Results Found</h1>
    </div>

@endif
