@extends('frontend.layouts.app')
@section('title')
  SAHULAT | Vendor Profile
@endsection
@section('custom-styles')
    <link rel="stylesheet" href="assets/css/templatemo-blue.css">
    <style>
        header { padding: 5%; }
        .intro { text-align: left; }
        .cards { background: #0f6674; }
        .titles { text-align: right; }
        .services-row { margin: 1%; }
        .profile-image { width: 150px; height: 150px; }
    </style>
@endsection
@section('content')


<!-- header section -->
<header>
	<div class="container" >
		<div class="row">
			<div class="col-md-3 col-sm-3 col-xs-12">
				<img src="../storage/images/user-profile-images/{{ $data['vendor']->user->profile_photo }}" width="150" height="150" class="img-responsive img-circle tm-border profile-image" alt="templatemo easy profile">
				<hr>
				<h5 class="tm-title bold shadow">Hi, I am {{ $data['vendor']->user->name }}</h5>
        {{-- rating code --}}
		      <div class="rating">
                  <input type="radio" name="rating" value="5" id="5"><label for="5">☆</label> <input type="radio" name="rating" value="4" id="4"><label for="4">☆</label> <input type="radio" name="rating" value="3" id="3"><label for="3">☆</label> <input type="radio" name="rating" value="2" id="2"><label for="2">☆</label> <input type="radio" name="rating" value="1" id="1"><label for="1">☆</label>
		      </div>
      {{-- end rating code --}}
               <div class="pt-5"> <a href="{{ route('editVendorProfile') }}" class="btn update">Update Profile</a></div>
			</div>
            <div class="col-md-9 col-sm-9 col-xs-12">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="skills cards">
                            <div class="row intro">
                                <div class="col-md-6 titles"> <h4>Name</h4> </div> <div class="col-md-6"> <h4>{{ $data['vendor']->user->name }}</h4> </div>
                            </div>
                            <div class="row intro">
                                <div class="col-md-6 titles"> <h4>Gender</h4> </div> <div class="col-md-6"> <h4>{{ $data['vendor']->user->gender }}</h4> </div>
                            </div>
                            <div class="row intro">
                                <div class="col-md-6 titles"> <h4>Rating</h4> </div> <div class="col-md-6"> <h4>{{ $data['vendor']->rating }}</h4> </div>
                            </div>
                            <div class="row intro">
                                <div class="col-md-6 titles"> <h4>Company</h4> </div> <div class="col-md-6"> <h4>{{ $data['vendor']->company_name }}</h4> </div>
                            </div>
                            <div class="row intro">
                                <div class="col-md-6 titles"> <h4>Business Location</h4> </div> <div class="col-md-6"> <h4>{{ $data['vendor']->business_location }}</h4> </div>
                            </div>
                            <div class="row intro">
                                <div class="col-md-6 titles"> <h4>Member Since</h4> </div> <div class="col-md-6"> <h4>{{ $data['vendor']->created_at->format('d M Y') }}</h4> </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="skills cards">
                            <h2 class="white">My Services</h2>
                            @foreach($data['services'] as $service)
                                <div class="row services-row">
                                    <div class="col-md-2">
                                        <img src="../storage/images/service-images/{{ $service->service_image }}" width="100" height="100" class="img-responsive img-circle">
                                    </div>
                                    <div class="col-md-10">
                                        <h3 align="left"> {{ $service->title }} </h3>
                                        <p align="left"> {{ $service->description }} </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
</header>

<!-- about and skills section -->

{{--<!-- education and languages -->--}}
{{--<section class="container">--}}
{{--	<div class="row">--}}
{{--		<div class="col-md-8 col-sm-12">--}}
{{--			<div class="education">--}}
{{--				<h2 class="white">Education</h2>--}}
{{--					<div class="education-content">--}}
{{--						<h4 class="education-title accent"></h4>--}}
{{--							<div class="education-school">--}}
{{--								<h5>School of Media</h5><span></span>--}}
{{--								<h5>2030 January - 2034 December</h5>--}}
{{--							</div>--}}
{{--						<p class="education-description">In lacinia leo sed quam feugiat, ac efficitur dui tristique. Ut venenatis, odio quis cursus egestas, nulla sem volutpat diam, ac dapibus nisl ipsum ut ipsum. Nunc tincidunt libero non magna placerat elementum.</p>--}}
{{--					</div>--}}
{{--			</div>--}}
{{--		</div>--}}
{{--		<div class="col-md-4 col-sm-12">--}}
{{--			<div class="languages">--}}
{{--				<h2>Languages</h2>--}}
{{--					<ul>--}}
{{--						<li>Myanmar / Thai</li>--}}
{{--						<li>English / Spanish</li>--}}
{{--						<li>Chinese / Japanese</li>--}}
{{--						<li>Arabic / Hebrew</li>--}}
{{--						<li>Urdu / Pakistan</li>--}}
{{--					</ul>--}}
{{--			</div>--}}
{{--		</div>--}}
{{--	</div>--}}
{{--</section>--}}

{{--<!-- contact and experience -->--}}
{{--<section class="container">--}}
{{--	<div class="row">--}}
{{--		<div class="col-md-4 col-sm-12">--}}
{{--			<div class="contact">--}}
{{--				<h2>Contact</h2>--}}
{{--					<p><i class="fa fa-map-marker"></i> 123 Rama IX Road, Bangkok</p>--}}
{{--					<p><i class="fa fa-phone"></i> 010-020-0890</p>--}}
{{--					<p><i class="fa fa-envelope"></i> easy@company.com</p>--}}
{{--					<p><i class="fa fa-globe"></i> www.company.com</p>--}}
{{--			</div>--}}
{{--		</div>--}}
{{--		<div class="col-md-8 col-sm-12">--}}
{{--			<div class="experience">--}}
{{--				<h2 class="white">Experiences</h2>--}}
{{--					<div class="experience-content">--}}
{{--						<h4 class="experience-title accent"></h4>--}}
{{--						<h5>New Media Company</h5><span></span>--}}
{{--						<h5>2035 January - 2036 April</h5>--}}
{{--						<p class="education-description">Cras porta tincidunt sem, in sollicitudin lorem efficitur ut. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet.</p>--}}
{{--					</div>--}}
{{--			</div>--}}
{{--		</div>--}}
{{--	</div>--}}
{{--</section>--}}

@endsection
