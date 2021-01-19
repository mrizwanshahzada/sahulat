@extends('frontend.layouts.app')
@section('title' )
SAHULAT | Update Profile
@endsection
@section('content')
      <!-- Page Header Start -->
      <div class="page-header" style="background: url({{ asset('assets/img/banner1.jpg') }})">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="breadcrumb-wrapper">
                <h2 class="product-title">Update Profile</h2>
                <ol class="breadcrumb">
                  <li><a href="#"><i class="ti-home"></i> Home</a></li>
                  <li class="current">Update Profile</li>
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
                  <li style="width: 100%;"><a>Update Details</a></li>
                </ul>
                <!-- Register -->
                <div id="cd-signup" class="is-selected">
                  <div class="page-login-form register">
                    <form method="POST" action="{{route('updateVendorProfile',$vendor->id) }}" role="form" class="login-form" enctype="multipart/form-data">
                        @csrf
                        {{--User Information--}}
                        <div class="form-group">
                        <div class="input-icon">
                          <i class="ti-user"></i>
                          <input type="text" id="sender-email" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Full Name" value="{{old('name',$vendor->user->name)}}">

                      @error('name')
                      <span class="invalid-feedback text-danger" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror


                       {{--    <input type="text" name="title" id="title" class="form-control {{ ($errors->any() && $errors->first('title')) ? 'is-invalid' : ''}}" value="{{old('title',$article->title)}}"> --}}
                        </div>
                      </div>
                        <div class="form-group">
                        <div class="input-icon">
                          <i class="ti-user"></i>
                          <input type="text" id="sender-email" class="form-control @error('phone') is-invalid @enderror" name="address" placeholder="address" value="{{old('address',$vendor->user->address)}}">
                           @error('address')
                      <span class="invalid-feedback text-danger" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror

                        </div>
                      </div>
                        <div class="form-group">
                        <div class="input-icon">
                          <i class="ti-user"></i>
                          <input type="text" id="sender-email" class="form-control @error('company_name') is-invalid @enderror" name="company_name" placeholder="Address" value="{{old('company_name',$vendor->company_name)}}">
                           @error('company_name')
                      <span class="invalid-feedback text-danger" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror

                        </div>
                      </div>
                        <div class="form-group">
                        <div class="input-icon">
                          <i class="ti-user"></i>
                          <input type="text" id="sender-email" class="form-control @error('business_location') is-invalid @enderror" name="business_location" placeholder="Address" value="{{old('business_location',$vendor->business_location)}}">
                           @error('business_location')
                      <span class="invalid-feedback text-danger" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                        </div>
                      </div>
                        <div class="form-group">
                          <div class="search-category-container">
                            <label class="styled-select">
                              <select name="gender" class="dropdown-product selectpicker @error('business_location') is-invalid @enderror" value="{{old('gender',$vendor->user->gender)}}">
                                <option>Male</option>
                                <option>Female</option>
                              </select>
                               @error('gender')
                      <span class="invalid-feedback text-danger" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                            </label>
                          </div>
                        </div>
                        <div class="form-group">
                            <div class="button-group">
                                <div class="action-buttons">
                                    <div class="upload-button">
                                        <button class="btn btn-common">Add Profile Photo</button>
                                        <input id="cover_img_file" type="file" name="profile_photo">
                                    </div>
                                </div>
                            </div>
                        </div>
                      <button class="btn btn-common log-btn">Save</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

     @endsection





