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
    </style>
@endsection
@section('content')


<!-- header section -->
<header>
	<div class="container" >
		<div class="row">
			<div class="col-md-3 col-sm-3 col-xs-12">
				<img src="../storage/images/user-profile-images/{{$employee->profile_photo}}" class="img-responsive img-circle tm-border" alt="templatemo easy profile">
				<hr>
				<h5 class="tm-title bold shadow">Hi, I am {{$employee->name}}</h5>
				<h5 class="white bold shadow">Service Provider</h5>
        {{-- rating code --}}
		      <div class="rating">
                @for($i=0 ; $i<$employee->employee->rating ; $i++)
                  <input type="radio" name="rating" value="5" id="5"><label for="5">☆</label>
                @endfor 
		      </div>
      {{-- end rating code --}}
               <div class="pt-5">
                <a href="{{route('updateProfile')}}" class="btn btn-common">Update Profile</a>
            </div>
			</div>
            <div class="col-md-9 col-sm-9 col-xs-12">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="skills cards">
                            <div class="row intro">
                                <div class="col-md-6 titles"> <h4>Name</h4> </div> <div class="col-md-6"> <h4>{{ $employee->name }}</h4> </div>
                            </div>
                            <div class="row intro">
                                <div class="col-md-6 titles"> <h4>Gender</h4> </div> <div class="col-md-6"> <h4>{{ $employee->gender }}</h4> </div>
                            </div>
                            <div class="row intro">
                                <div class="col-md-6 titles"> <h4>Rating</h4> </div> <div class="col-md-6"> <h4>{{$employee->employee->rating}}</h4> </div>
                            </div>
                           
                            <div class="row intro">
                                <div class="col-md-6 titles"> <h4>Member Since</h4> </div> <div class="col-md-6"> <h4>{{ $employee->created_at->format('d M Y') }}</h4> </div>
                            </div>
                        </div>
                    </div>
                </div>
               <!--  <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="skills cards">
                            <h2 class="white">Services</h2>
                            <strong>Mobile repairing</strong>
                            <span class="pull-right">70%</span>
                            <div class="progress">
                                <div class="progress-bar progress-bar-primary" role="progressbar"
                                     aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%;"></div>
                            </div>
                            <strong>Laptop Repairing</strong>
                            <span class="pull-right">85%</span>
                            <div class="progress">
                                <div class="progress-bar progress-bar-primary" role="progressbar"
                                     aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 85%;"></div>
                            </div>
                            <strong>Desktop Repairing</strong>
                            <span class="pull-right">95%</span>
                            <div class="progress">
                                <div class="progress-bar progress-bar-primary" role="progressbar"
                                     aria-valuenow="95" aria-valuemin="0" aria-valuemax="100" style="width: 95%;"></div>
                            </div>
                            <strong>Windows Installation</strong>
                            <span class="pull-right">80%</span>
                            <div class="progress">
                                <div class="progress-bar progress-bar-primary" role="progressbar"
                                     aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%;"></div>
                            </div>
                        </div>
                    </div>
                </div> -->
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
{{--					<p><i class="fa fa-phone"></i>     
                        {{$employee->phone}}</p>--}}
{{--					<p><i class="fa fa-envelope"></i> 
                        {{$employee->email}}</p>--}}
{{--					--}}
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
