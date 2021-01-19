 
@extends('frontend.layouts.app')
@section('title', 'SAHULAT | Employee Update Profile')
@section('content')
      <!-- Page Header Start -->
      <div class="page-header" style="background: url({{ asset('assets/img/banner1.jpg') }})">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="breadcrumb-wrapper">
                <h2 class="product-title">User Update</h2>
                <ol class="breadcrumb">
                  <li><a href="#"><i class="ti-home"></i> Home</a></li>
                  <li class="current">User Update</li>
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
                  <li style="width: 100%;"><a>Update</a></li>
                </ul>
                <!-- Register -->
                <div id="cd-signup" class="is-selected">
                  <div class="page-login-form register">
                    <form method="POST" action="{{ route('updateEmployee') }}" role="form" class="login-form" enctype="multipart/form-data">
                        @csrf
                       <input type="hidden" name="_method" value="PUT">
                        {{--User Information--}}
                        <div class="form-group">
                        <div class="input-icon">
                          <i class="ti-user"></i>
                          <input type="text" id="sender-email" class="form-control" name="name" placeholder="Full Name" value="{{old('name',$user->name)}}">


                       {{--    <input type="text" name="title" id="title" class="form-control {{ ($errors->any() && $errors->first('title')) ? 'is-invalid' : ''}}" value="{{old('title',$article->title)}}"> --}}
                        </div>
                      </div>
                        <div class="form-group">
                        <div class="input-icon">
                          <i class="ti-user"></i>
                          <input type="text" id="sender-email" class="form-control" name="phone" placeholder="Phone Number" value="{{old('phone',$user->phone)}}">
                        </div>
                      </div>
                        <div class="form-group">
                        <div class="input-icon">
                          <i class="ti-user"></i>
                          <input type="text" id="sender-email" class="form-control" name="address" placeholder="Address" value="{{old('address',$user->address)}}">
                        </div>
                      </div>
                        <div class="form-group">
                          <div class="search-category-container">
                            <label class="styled-select">
                              <select name="gender" class="dropdown-product selectpicker" value="{{old('gender',$user->gender)}}">
                                <option>Gender</option>
                                <option>Male</option>
                                <option>Female</option>
                              </select>
                            </label>
                          </div>
                        </div>
                        <div class="form-group">
                        <div class="input-icon">
                          <i class="ti-email"></i>
                          <input type="text" id="sender-email" class="form-control" name="email" placeholder="Email" value="{{old('email',$user->email)}}">
                        </div>
                      </div>
                        <div class="form-group">
                            <div class="input-icon">
                              <i class="ti-lock"></i>
                              <input name="password" type="password" class="form-control" placeholder="Password">
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