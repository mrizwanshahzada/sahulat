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
                  <li><a class="selected" href="#0">LOGIN</a></li>
                  <li><a href="#0">REGITER</a></li>
                </ul>
                <!-- Login -->
                <div id="cd-login" class="is-selected">
                  <div class="page-login-form">
                    <form role="form" class="login-form"
                    action="{{ route('vendorProfile') }}" >
                      <div class="form-group">
                        <div class="input-icon">
                          <i class="ti-user"></i>
                          <input type="text" id="sender-email" class="form-control" name="email" placeholder="Username">
                        </div>
                      </div> 
                      <div class="form-group">
                        <div class="input-icon">
                          <i class="ti-lock"></i>
                          <input type="password" class="form-control" placeholder="Password">
                        </div>
                      </div> 
                      <button class="btn btn-common log-btn " type="submit">Login</button>
                      <div class="checkbox-item">
                        <div class="checkbox">
                          <label for="rememberme" class="rememberme">
                          <input name="rememberme" id="rememberme" value="forever" type="checkbox"> Remember Me</label>
                        </div>                        
                        <p class="cd-form-bottom-message"><a href="#0">Lost your password?</a></p>
                      </div> 
                    </form>
                  </div>
                </div>

                <!-- Register -->

                <div id="cd-signup">
                  <div class="page-login-form register">
                    <form role="form" class="login-form" method="POST" action="{{route('vendor.store')}}" enctype="multipart/form-data">
                      
                      @csrf

                      <div class="form-group">
                        <div class="input-icon">
                          <i class="ti-user"></i>
                          <input type="text" id="sender-email" class="form-control" name="name" placeholder="Name">
                        </div>
                      </div>

                       <div class="form-group">
                        <div class="input-icon">
                          <i class="ti-user"></i>
                          <input type="text" id="sender-email" class="form-control" name="phone" placeholder="Phone">
                        </div>
                      </div>

                       <div class="form-group">
                        <div class="input-icon">
                          <i class="ti-user"></i>
                          <input type="text" id="sender-email" class="form-control" name="address" placeholder="Address">
                        </div>
                      </div>

                  <div class="form-group">
                  <div class="search-category-container">
                    <label class="styled-select">
                      <select class="dropdown-product selectpicker" 
                      name="gender">
                        <option>gender</option>
                        <option>Mail</option>
                        <option>Femail</option>
                      </select>
                    </label>
                  </div>
                </div>



                      <!-- <div class="form-group">
                        <div class="input-icon">
                          <i class="ti-user"></i>
                          <input type="text" id="sender-email" class="form-control" name="uname" placeholder="Username">
                        </div>
                      </div>  -->
                      <div class="form-group">
                        <div class="input-icon">
                          <i class="ti-email"></i>
                          <input type="text" id="sender-email" class="form-control" name="email" placeholder="Email">
                        </div>
                      </div> 

                      <div class="form-group">
                        <div class="input-icon">
                          <i class="ti-lock"></i>
                          <input type="password" class="form-control" name="password" placeholder="Password">
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="input-icon">
                          <i class="ti-lock"></i>
                          <input type="password" class="form-control" placeholder="Repeat Password">
                        </div>
                      </div>

                  <div class="form-group">
                  <label class="control-label" for="textarea">Company Name</label>
                  <input type="text" name="company_name" class="form-control"  placeholder="Company name">
                </div>
                  <div class="form-group">
                  <label class="control-label" for="textarea">Bussiness Location</label>
                  <input type="text" name="bussiness_location" class="form-control"  placeholder="Company name">
                </div>


                <div class="form-group">
                  <div class="button-group">
                    <div class="action-buttons">
                      <div class="upload-button">
                        <button class="btn btn-common">Add Profile image</button>
                        <input id="cover_img_file" name="profile_img" type="file">
                      </div>
                    </div>
                  </div>
                </div> 

               <div class="divider"><h3>Add Service</h3></div>
                <div class="form-group">
                  <label class="control-label" for="textarea">Service Title</label>
                  <input type="text" name="service_title" class="form-control" placeholder="Name">
                </div>
                <div class="form-group">
                  <label class="control-label" for="textarea"></label>
                  <label class="control-label" for="textarea">Frequency</label>
                  <input type="text" name="service_frequency" class="form-control"  >
                </div>
                <div class="form-group">
                  <label class="control-label" for="textarea">Service Charges</label>
                  <input type="text" name="service_charges" class="form-control"  placeholder="">
                </div> 
                <div class="form-group">
                  <label class="control-label" for="textarea">Requirements</label>
                  <input type="text" name="requirements" class="form-control"  placeholder="Location, e.g">
                </div>  
 


                <div class="form-group">
                  <div class="button-group">
                    <div class="action-buttons">
                      <div class="upload-button">
                        <button class="btn btn-common">Add Service image</button>
                        <input id="service_img_file" name="service_imge" type="file">
                      </div>
                    </div>
                  </div>
                </div>  
   


                <div class="form-group">
                  <label class="control-label" for="textarea">Description</label>  
                  <textarea class="form-control" name="service_description" rows="7"></textarea>                
                </div>                  
  



                      <button type="submit" class="btn btn-common log-btn">Register</button> 
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

