@extends('frontend.layouts.app')
@section('title' )
SAHULAT | User Update
@endsection
@section('custom-styles')
    <style type="text/css">
    .errors { color: red; display: inline;}
    </style>
@endsection
@section('content')
      <!-- Page Header Start -->
      <div class="page-header" style="background: url({{ asset('assets/img/banner1.jpg') }})">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="breadcrumb-wrapper">
                <h2 class="product-title">User Update</h2>
                <ol class="breadcrumb">
                  <li><a href="{{route('/')}}"><i class="ti-home"></i> Home</a></li>
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
                
                <!-- Register -->
                <div id="cd-signup" class="is-selected">
                  <div class="page-login-form register">
                    <form method="POST" action="{{route('customerUpdateProfile') }}" role="form" class="login-form" enctype="multipart/form-data">
                        @csrf
                    <button class="btn btn-common log-btn">Update</button>
                        {{--User Information--}}
                        <div class="form-group">
                        <div class="input-icon">
                          <i class="ti-user"></i>
                          
                          <input type="text" id="sender-email" class="form-control" name="name" placeholder="Full Name" value="{{old('name',$user->name)}}">
                          <label>@error('name') <p class="errors"> {{ $message }} </p> @enderror</label>


                       {{--    <input type="text" name="title" id="title" class="form-control {{ ($errors->any() && $errors->first('title')) ? 'is-invalid' : ''}}" value="{{old('title',$article->title)}}"> --}}
                        </div>
                      </div>
                        <div class="form-group">
                        <div class="input-icon">
                          <i class="ti-user"></i>
                          <input type="text" id="sender-email" class="form-control" name="phone" placeholder="Phone Number" value="{{old('phone',$user->phone)}}">
                          <label>@error('phone') <p class="errors"> {{ $message }} </p> @enderror</label>
                        </div>
                      </div>
                        <div class="form-group">
                        <div class="input-icon">
                          <i class="ti-user"></i>
                          <input type="text" id="sender-email" class="form-control" name="address" placeholder="Address" value="{{old('address',$user->address)}}">
                           <label>@error('address') <p class="errors"> {{ $message }} </p> @enderror</label>
                        </div>
                      </div>
                        <div class="form-group">
                          <div class="search-category-container">
                            <label class="styled-select">
                              <select name="gender" class="dropdown-product selectpicker" value="{{old('gender',$user->gender)}}">
                                
                                <option>Male</option>
                                <option>Female</option>
                              </select>
                            </label>
                             <label>@error('gender') <p class="errors"> {{ $message }} </p> @enderror</label>
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





