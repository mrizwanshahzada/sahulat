@extends('frontend.layouts.app')
@section('title' , 'SAHULAT | Register')
@section('content')

<!-- Page Header Start -->
<div class="page-header" style="background: url(assets/img/banner1.jpg);">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="breadcrumb-wrapper">
          <h2 class="product-title">Registraion</h2>
          <ol class="breadcrumb">
            <li><a href="#"><i class="ti-home"></i> Home</a></li>
            <li class="current">Registraion</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Page Header End -->
<br>
<div class="container">
    <div class="row">
      <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="card">
              <div class="my-account-form">
                <ul class="cd-switcher">
                  <li style="width: 100%;"><a>REGISTER</a></li>
                </ul>
              </div>
                <div class="card-body page-login-form">
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
                            <option value="Fe Male">Fe Male</option>
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
        </div>
    </div>
</div>

@endsection
