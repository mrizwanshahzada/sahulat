@extends('frontend.layouts.app')
@section('title')
SAHULAT | Buy A Service
@endsection

@section('custom-styles')
 <style type="text/css">
   .subscription-form-container{
        width: 80%;
        margin-top: 5%;
        margin-bottom: 10%;
   }
   .subscription-form{
        width: 70%;
        margin: auto;
   }
   .subscribe-button{
        width: 100%;
   }
   .errors { color: red; display: inline;}
   /* The Modal (background) */
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
               <h2 class="product-title">Buy A Service</h2>
               <ol class="breadcrumb">
                  <li><a href="#"><i class="ti-home"></i> Home</a></li>
                  <li class="current">Buy A Service</li>
               </ol>
            </div>
         </div>
      </div>
   </div>
</section>

<div class="container subscription-form-container">
   <div class="job-list">
      <div class="thumb">
         <a href="job-details.html"><img src="assets/img/jobs/img-3.jpg" alt=""></a>
      </div>
      <div class="job-list-content">
         <h4><a href="job-details.html">{{ $service->title }}</a><span class="part-time">Available</span></h4>
         <p>{{$service->description}}</p>
         <div class="job-tag">
            <div class="pull-left">
               <div class="meta-tag">

                  <span><i class="ti-time"></i>Charges: {{$service->charges}}</span>
               </div>
            </div>
         </div>
      </div>
   </div>

   <form  class="for-ad subscription-form"  id="payment-form"
    action="{{route('userBuyService',$service) }}">

    <input type="hidden" name="lat" id="lat">
    <input type="hidden" name="long" id="long">

    @csrf
    <div class="row">

    <div class="col-md-12">
    <input type="date" id="sender-email" class="form-control" name="date" required min="2020-10-22">
    <label>@error('date') <p class="errors"> {{ $message }} </p> @enderror</label>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div id="card-element" class="form-control">
                        <!-- Elements will create input elements here -->
     </div>
  </div>
</div>
 <div class="row">
   <div class="col-md-12">
     <div id="card-errors" role="alert"></div>
   </div>
 </div>
  <div class="row">
    <div class="col-md-12">


    <button id="submit" class="btn btn-success subscribe-button">Buy</button>




    </div>
  </div>
  </form>
  </div>
</div>

 <div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">

      <h2 class="text-center " style="color:white;background-color: #F96B73;">Payment Confirmation</h4>

    <!-- <span class="close">&times;</span> -->
     <CENTER><p>Your Payment Has been completed Successfully.....</p>
    <a href="{{route('/')}}"><BUTTON class="btn btn-success mt-3">OK</BUTTON></a></CENTER>
  </div>

</div>

@endsection



@section('custom-scripts')
     <script src="https://js.stripe.com/v3/"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
     <script type="text/javascript">
      getLocation();

      var lat = document.getElementById('lat');
      var long = document.getElementById('long');

      var modal = document.getElementById("myModal");

var span = document.getElementsByClassName("close")[0];

      console.log("{{config('app.stripe_public_key')}}");
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

        card.on('change', ({error}) => {
        const displayError = document.getElementById('card-errors');
        if (error) {
          displayError.textContent = error.message;
        } else {
          displayError.textContent = '';
        }
      });
        var submit = document.getElementById('submit');
        var form = document.getElementById('payment-form');
        var cardError = document.getElementById('card-errors');
        var formdata;
        var status=0;



  form.addEventListener('submit', function(ev) {
  ev.preventDefault();
  submit.setAttribute("disabled", true);
  submit.setAttribute('value' , 'Processing');
  stripe.confirmCardPayment('{{$client_secret}}', {
    payment_method: {
      card: card,
      billing_details: {
        name: '{{Auth::user()->name}}'
      }
    }
  }).then(function(result) {
    if (result.error) {
      // Show error to your customer (e.g., insufficient funds)
      cardError.innerText = result.error.message;
      console.log(result.error.message);


    submit.disabled = false;

    } else {
      // The payment has been processed!
      cardError.innerText = "Payment Complete";

      console.log('responce : '+result.paymentIntent.status);
      if (result.paymentIntent.status === 'succeeded') {


        status = 200;
         var data = new FormData(form)
        axios.post("{{route('userBuyService',$service) }}",data).then((res)=>{
          console.log("responce status :"+res.status)
        if(res.status ==200){
          console.log('inside if');

          modal.style.display = "block";
          // window.location.href = "{{route('customerDashboard')}}";
           // cardError.innerText = "Request Complete";
        }
        });
      }
    }
  })

});






  var lat1 = 0;
      var lon1 = 0;

        var x = document.getElementById("demo");
        var taskID = document.querySelectorAll(".location-btn");
        taskID.forEach(function(e) {
        e.addEventListener("click", function() {
                lat1 =this.dataset.lat;
                lon1 =  this.dataset.long;
           getLocation(this.getAttribute('id'))
        });
    });

    var id;

    function getLocation() {
      
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
      } else { 
        x.innerHTML = "Geolocation is not supported by this browser.";
      }
    }

    function showPosition(position) {
     
      
      var lat2 = position.coords.latitude;
      var lon2 = position.coords.longitude;
      
      lat.value = position.coords.latitude;
      long.value = position.coords.longitude;
      
    }

    function requestProcess(status) {
      $.ajax({
          url:'{{route('employeeVerifyVendor')}}',
          method: "post",
          data: {"id":id, "status":status, "_token": "{{ csrf_token() }}"},
          success:function(result)
          {
            if(result != ""){
              location.reload();
            }
          }
      });
    }

    function calcCrow(lat1, lon1, lat2, lon2) 
    {
      var R = 6371; // km
      var dLat = toRad(lat2-lat1);
      var dLon = toRad(lon2-lon1);
      var lat1 = toRad(lat1);
      var lat2 = toRad(lat2);

      var a = Math.sin(dLat/2) * Math.sin(dLat/2) +
        Math.sin(dLon/2) * Math.sin(dLon/2) * Math.cos(lat1) * Math.cos(lat2); 
      var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
      var d = R * c;
      return d;
    }

    // Converts numeric degrees to radians
    function toRad(Value) 
    {
        return Value * Math.PI / 180;
    }




     </script>
     @endsection
