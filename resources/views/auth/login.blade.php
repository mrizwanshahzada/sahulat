@extends('frontend.layouts.app')
@section('title' , 'SAHULAT | Login')

@section('content')

<!-- Page Header Start -->
<div class="page-header" style="background: url(assets/img/banner1.jpg);">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="breadcrumb-wrapper">
					<h2 class="product-title">My Account</h2>
					<ol class="breadcrumb">
						<li><a href="#"><i class="ti-home"></i> Home</a></li>
						<li class="current">My Account</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Page Header End -->



<div id="content" class="my-account">
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-6 cd-user-modal">
				<div class="my-account-form">
					<ul class="cd-switcher">
						<li><a class="selected" href="">LOGIN</a></li>
 
						<li><a href="{{route('register')}}">REGITER</a></li>
 
 
					</ul>
					<!-- Login -->

					<div id="cd-login" class="is-selected">
						<div class="page-login-form">
							<form method="POST" action="{{ route('login') }}" role="form" class="login-form">
							@csrf
							<div class="form-group">
								<div class="input-icon">
									<i class="ti-user"></i>
									<input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email" value="{{ old('email') }}" required autocomplete="email" autofocus>

									@error('email')
									<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
									</span>
									@enderror
								</div>
							</div>
							<div class="form-group">
								<div class="input-icon">
									<i class="ti-lock"></i>
									<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="current-password">

									@error('password')
									<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
									</span>
									@enderror

								</div>
							</div>
							<div>
								<button class="btn btn-common log-btn">Login</button>

							</div>

							<div class="checkbox-item">
								<p class="cd-form-bottom-message"><a href="{{ route('password.request') }}">Lost your password?</a></p>
							</div>
							</form>
						</div>
					</div>

					<!-- Register -->

					<div id="cd-signup">
						<div class="page-login-form register">
							<form method="POST" action="{{ route('register') }}" role="form" class="login-form" enctype="multipart/form-data">

							@csrf

							<div class="form-group">
								<div class="input-icon">
									<i class="ti-user"></i>
									<input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Name" value="{{ old('name') }}" required autocomplete="name" autofocus>

									@error('name')
									<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
									</span>
									@enderror

								</div>
							</div>

							<div class="form-group">
								<div class="input-icon">
									<i class="ti-mobile"></i>
									<input type="number" id="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" placeholder="Phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>

									@error('phone')
									<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
									</span>
									@enderror

								</div>
							</div>

							<div class="form-group">
								<div class="input-icon">
									<i class="ti-home"></i>
									<input type="text" id="address" class="form-control @error('address') is-invalid @enderror" name="address" placeholder="Address" value="{{ old('address') }}" required autocomplete="address" autofocus>

									@error('address')
									<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
									</span>
									@enderror
								</div>
							</div>

							<div class="form-group">
								<div class="search-category-container">
									<label class="styled-select">
									<select name="gender" class="dropdown-product selectpicker">
									<option value="Male">Male</option>
									<option value="Female">Female</option>
									</select>
									@error('gender')
									<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
									</span>
									@enderror
									</label>
								</div>
							</div>


							<div class="form-group">
								<div class="input-icon">
									<i class="ti-email"></i>
									<input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email" value="{{ old('email') }}" required autocomplete="email">

									@error('email')
									<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
									</span>
									@enderror

								</div>
							</div>

							<div class="form-group">
								<div class="input-icon">
									<i class="ti-lock"></i>
									<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">

									@error('password')
									<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
									</span>
									@enderror

								</div>
							</div>

							<div class="form-group">
								<div class="input-icon">
									<i class="ti-lock"></i>
									<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Repeat Password">
								</div>
							</div>




							<div class="form-group">
								<div class="button-group">
									<div class="action-buttons">
										<div class="upload-button">
											<button class="btn btn-common">Add Profile image</button>
											<input id="profile_photo" type="file" class="form-control" name="profile_photo">

											@error('profile_photo')
											<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
											</span>
											@enderror
										</div>
									</div>
								</div>
							</div>

								<button class="btn btn-common log-btn">Register</button>
							</form>
						</div>
					</div>
					<div class="page-login-form" id="cd-reset-password">

						<!-- reset password form -->
						<p class="cd-form-message">Lost your password? Please enter your email address. You will receive a link to create a new password.</p>
						<form class="cd-form">
							<div class="form-group">
								<div class="input-icon">
									<i class="ti-email"></i>
									<input type="text" id="sender-email" class="form-control" name="email" placeholder="Email">
								</div>
							</div>
							<p class="fieldset">
							<button class="btn btn-common log-btn" type="submit">Reset password</button>
							</p>
						</form>
						<p class="cd-form-bottom-message"><a href="#0">Back to log-in</a></p>
					</div> <!-- cd-reset-password -->
				</div>
			</div>
		</div>
	</div>
</div>


@endsection