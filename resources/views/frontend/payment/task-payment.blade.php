@extends('frontend.layouts.app')

@section('title')
  SAHULAT | Service details
@endsection


@section('content')
      <div id="content" class="my-account">
        <div class="container">
          <div class="row">
            <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-6 cd-user-modal">
              <div class="my-account-form">
                <div class="cd-switcher">
                  <div class="text-center log-btn"  style="width: 100%; background-color: #ff4f57; min-height: 4rem; color: white;
                  ">
                  
                        <h4 class="">
                           Payment
                        </h4>

                  
                  
                </div>
                <div class="w-100">
                  <img class="img-responsive cc-img" src="http://www.prepbootstrap.com/Content/images/shared/misc/creditcardicons.png">
                </div>
                </div>

                <!-- Register -->
                <div id="cd-signup" class="is-selected">
                  <div class="page-login-form register">
                    
                    <form action="{{route('payment',[$service ,  $deadline])}}" method="POST"  role="form" class="login-form" enctype="multipart/form-data">
                        @csrf
                    
                        <div class="form-group">
                        <div class="input-icon">
                          <label>Name on Card</label>
                          <input type="text" class="form-control" name="name" >
                        </div>
                      </div>
                        <div class="form-group">
                        <div class="input-icon">
                          <label>Card No</label>
                          <input type="number" id="sender-email" class="form-control" name="card_no" >
                        </div>
                      </div>

                      <div class="form-group">
                         <div class='form-row'>
                            <div class='col-xs-4 form-group cvc required'>
                                <label class='control-label'>CVC</label>
                                 <input autocomplete='off' class='form-control card-cvc' name="cvc" placeholder='ex. 311' size='4'
                                    type='text'>
                            </div>
                            <div class='col-xs-4 form-group expiration required'>
                                <label class='control-label'>Expiration Month</label> 
                                <input class='form-control card-expiry-month' name = 'month'  placeholder='MM' size='2'
                                    type='text'>
                            </div>
                            <div class='col-xs-4 form-group expiration required'>
                                <label class='control-label'> Expiration Year</label> 
                                <input class='form-control card-expiry-year' name = 'year'  placeholder='YYYY' size='4' type='text'>
                            </div>
                     </div>   
                        
                      </div>
                       
                        
      
                      <button class="btn btn-info log-btn">Total bill :{{$service->charges}}</button>
                      <button class="btn btn-primary log-btn" type="submit">Pay</button>
                    </form>
                  </div>
                </div>
         
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection

