@extends('frontend.layouts.app')
@section('title')
SAHULAT | Subscribe A Service
@endsection
@section('custom-styles')
<style type="text/css">
  .subscription-form-container{
    width: 80%;
    margin-top: 5%;
    margin-bottom: 10%;
  }
  .subscription-form{
    width: 100%;
    margin: auto;
  }
  .subscribe-button{
    width: 100%
  }
  .modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
  }

  /* Modal Content */
  .modal-content {
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 50%;
  }

  /* The Close Button */
  .close {
    color: #aaaaaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
  }

  .close:hover,
  .close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
  }
</style>
@endsection
@section("content")
<section class="page-header" style="background: url({{ asset('assets/img/banner1.jpg') }})">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="breadcrumb-wrapper">
          <h2 class="product-title">Subscribe A Service</h2>
          <ol class="breadcrumb">
            <li><a href="#"><i class="ti-home"></i> Home</a></li>
            <li class="current">Subscribe A Service</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
</section>
<div class="container subscription-form-container">
  <div class="job-list" style="width: 100%;">
    <div class="row">
      <div class="col-md-4">
        <img src="../storage/images/service-images/{{ $service->service_image }}" class="rounded-circle img-fluid" style="width: 100%; height: 150px;">
      </div>
      <div class="col-md-8">
        <div class="job-list-content" style="width: 100%; margin: 0;">
          <h4><a href="job-details.html">{{ $service->title }}</a><span class="part-time">Available</span></h4>
          <p>{{$service->description}}</p>
          <div class="job-tag">
            <div class="pull-left">
              <div class="meta-tag">
                <span><i class="ti-location-pin"></i>Lahore</span>
                <span><i class="ti-time"></i>Charges: {{$service->charges}}</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
    <div class="row">
      <div class="col-md-6">
        <input type="hidden" name="service_id" value="{{$service->id}}">
        <strong>Choose Duration Of Subscription</strong>
        <select class="form-control" name="duration" id="duration">
            <option value="30">One Month</option>
            <option value="180">Six Months</option>
            <option value="360">One Year</option>
        </select>
      </div>
      <div class="col-md-6">
        <strong>Enter How Frequently You Want To Get This Service (Enter Days)</strong>
        <input class="form-control" type="number" name="frequency" id='frequency' value="{{ $service->frequency }}">
      </div>
    </div>

    <dir class="row" style="padding: 2%;">
        <strong>Please Enter Your Card Number </strong>
     <div id="card-element" class="form-control col-12" required>
      <!-- Elements will create input elements here -->
    </div>
  </dir>
</dir>
<div class="row">
 <div class="col-md-12">
   <div id="card-errors" role="alert"></div>
 </div>
</div>

<div class="row">
  <div class="col-md-12">
    <button class="btn btn-success subscribe-button" id="subscribe-button">Subscribe</button>
  </div>
</div>
</div>
</div>
<div class="d-none" id="error">ok</div>

<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">

    <h2 class="text-center " style="color:white;background-color: #F96B73;">Payment Confirmation</h2>


      <CENTER><p>Your Payment Has been completed Successfully.....</p>
        <a href="{{route('/')}}"><BUTTON class="btn btn-success mt-3">OK</BUTTON></a></CENTER>
      </div>

    </div>





    @endsection


    @section('custom-scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script type="text/javascript">

      // $('#subscribe-button').click(function(){

      // });

      var errors = document.getElementById('error');
      var stripe = Stripe("{{config('app.stripe_public_key')}}");
      var elements = stripe.elements();
      // Set up Stripe.js and Elements to use in checkout form
      var style = {
        base: {
          color: "#32325d",
        }
      };

      var card = elements.create("card", { style: style });
      card.mount("#card-element");

      card.required;
      card.on('change', ({error}) => {
        const displayError = document.getElementById('card-errors');
        if (error) {
          displayError.textContent = error.message;
        } else {
          displayError.textContent = '';
          errors.innerText = '';
        }
      });

      var modal = document.getElementById("myModal");


      var cardError = document.getElementById('card-errors');
      var subscribeButton = document.getElementById('subscribe-button')
      subscribeButton.addEventListener('click', function(ev) {
          if(parseInt($('#duration').val()) >= $('#frequency').val()){
              var tasks = ($('#duration').val() / $('#frequency').val());
              var totalBill = Math.floor(tasks)* '{{ $service->charges }}';
              Swal.fire({
                  title: 'Your bill is '+totalBill,
                  text: "Please Click On Confirm to Continue",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Confirm'
              }).then((result) => {
                  if (result.isConfirmed) {
                      ev.preventDefault();
                      var elements = document.getElementsByClassName('InputElement')
                      if(cardError.textContent == '' && errors.textContent == ''){
                          $.post(
                              '{{ route("subscribeService") }}',
                              {
                                  service_id: '{{ $service->id }}',
                                  duration: $('#duration').val(),
                                  frequency: $('#frequency').val(),
                                  bill: totalBill,
                                  _token: $('meta[name="csrf-token"]').attr('content')
                              },
                              function(e){
                                  modal.style.display = "block";
                              });
                      }
                  }
              });
          }else{
              Swal.fire({
                  title: 'frequency cannot be more than duration !',
                  text: "Please Click On Confirm to Continue",
                  icon: 'warning',
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'OK'
              });
          }


      });

    </script>
    @endsection
