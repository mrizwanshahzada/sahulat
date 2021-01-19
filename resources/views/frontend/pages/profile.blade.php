@extends('frontend.layouts.app')

@section('title')
  SAHULAT | My Profile
@endsection


@section('custom-styles')
    <link rel="stylesheet" href="assets/css/templatemo-blue.css">
@endsection


@section('content')


<!-- header section -->
<header>
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<img src="assets/img/tm-easy-profile.jpg" class="img-responsive img-circle tm-border" alt="templatemo easy profile">
				<hr>
				<h1 class="tm-title bold shadow">Hi, I am Julia</h1>
				<h1 class="white bold shadow">Service Provider</h1>
        {{-- rating code --}}
		      <div class="rating "> <input type="radio" name="rating" value="5" id="5"><label for="5">☆</label> <input type="radio" name="rating" value="4" id="4"><label for="4">☆</label> <input type="radio" name="rating" value="3" id="3"><label for="3">☆</label> <input type="radio" name="rating" value="2" id="2"><label for="2">☆</label> <input type="radio" name="rating" value="1" id="1"><label for="1">☆</label>
		      </div>
      {{-- end rating code --}}
               <div class="pt-5"> <button class="btn-lg update">Update Profile</button></div>


			</div>
		</div>
	</div>
</header>

<!-- about and skills section -->
<section class="container">
	<div class="row">
		<div class="col-md-6 col-sm-12">
			<div class="about">
				<h3 class="accent">My Details</h3>
				<h2></h2>
				<p>I'm professional of mobile reparing. My team will help
				you to solve all the issues of mobile as well as laptop, desktop
				etc. We'll work at time which you given  <a href="index-green.html">Green</a>, <a href="index.html">Blue</a>, <a href="index-gray.html">Gray</a>, and <a href="index-orange.html">Orange</a>. Sed vitae dui in neque elementum tempor eu id risus. Phasellus sed facilisis lacus, et venenatis augue.</p>

			</div>
		</div>
		<div class="col-md-6 col-sm-12">
			<div class="skills">
				<h2 class="white">Provide Services</h2>
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
				 <button class="navbar-right btn-primary">Add Services</button>
			</div>
		</div>
	</div>
</section>

<!-- education and languages -->
<section class="container">
	<div class="row">
		<div class="col-md-8 col-sm-12">
			<div class="education">
				<h2 class="white">Education</h2>
					<div class="education-content">
						<h4 class="education-title accent"></h4>
							<div class="education-school">
								<h5>School of Media</h5><span></span>
								<h5>2030 January - 2034 December</h5>
							</div>
						<p class="education-description">In lacinia leo sed quam feugiat, ac efficitur dui tristique. Ut venenatis, odio quis cursus egestas, nulla sem volutpat diam, ac dapibus nisl ipsum ut ipsum. Nunc tincidunt libero non magna placerat elementum.</p>
					</div>
			</div>
		</div>
		<div class="col-md-4 col-sm-12">
			<div class="languages">
				<h2>Languages</h2>
					<ul>
						<li>Myanmar / Thai</li>
						<li>English / Spanish</li>
						<li>Chinese / Japanese</li>
						<li>Arabic / Hebrew</li>
						<li>Urdu / Pakistan</li>
					</ul>
			</div>
		</div>
	</div>
</section>

<!-- contact and experience -->
<section class="container">
	<div class="row">
		<div class="col-md-4 col-sm-12">
			<div class="contact">
				<h2>Contact</h2>
					<p><i class="fa fa-map-marker"></i> 123 Rama IX Road, Bangkok</p>
					<p><i class="fa fa-phone"></i> 010-020-0890</p>
					<p><i class="fa fa-envelope"></i> easy@company.com</p>
					<p><i class="fa fa-globe"></i> www.company.com</p>
			</div>
		</div>
		<div class="col-md-8 col-sm-12">
			<div class="experience">
				<h2 class="white">Experiences</h2>
					<div class="experience-content">
						<h4 class="experience-title accent"></h4>
						<h5>New Media Company</h5><span></span>
						<h5>2035 January - 2036 April</h5>
						<p class="education-description">Cras porta tincidunt sem, in sollicitudin lorem efficitur ut. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet.</p>
					</div>
			</div>
		</div>
	</div>
</section>

@endsection

@section('custom-scripts')
<script src="assets/js/custom.js"></script>
<script src="assets/js/jquery.backstretch.min.js"></script>


@endsection