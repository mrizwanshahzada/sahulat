
@extends('frontend.layouts.app')
@section('title' , 'SAHULAT | Buy Service')

@section('custom-styles')

<style>
body {font-family: Arial, Helvetica, sans-serif;}

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

@section('content')
      <!-- Page Header Start -->

      <div class="page-header" style="background: url({{ asset('assets/img/banner1.jpg') }})">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="breadcrumb-wrapper">
                <h2 class="product-title">Buy Service</h2>
                <ol class="breadcrumb">
                  <li><a href="#"><i class="ti-home"></i> Home</a></li>
                  <li class="current">Buy Service</li>
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
                  <li style="width: 100%;"><a>Buy Service</a></li>
                </ul>
                <!-- Register -->
                <div id="cd-signup" class="is-selected">
                  <div class="page-login-form register">
                    <form method="get" id="payment-form" action="" role="form" >
                        @csrf


                        <div class="form-group">
                        <div class="input-icon">
                          <label>Service Name</label>
                          <input type="text"
                            value="{{$task->service->title}}"
                           id="sender-email" class="form-control" name="name" placeholder="Full Name" readonly="">
                        </div>
                      </div>
                        <div class="form-group">
                        <div class="input-icon">
                          <label>Vendor Name</label>
                          <input type="text" id="sender-email" class="form-control" name="vendor_name" placeholder="Phone Number" readonly=""
                          value="{{$task->service->vendor->user->name}}">
                        </div>
                      </div>
                        <div class="form-group">
                        <div class="input-icon">
                          <label>Budget</label>
                          <input type="text" id="sender-email" readonly="" class="form-control" name="budget" value="{{$task->budget}}"
                           placeholder="Address">
                        </div>
                      </div>

                        <div class="form-group">
                        <div class="input-icon">
                          <label>Deadline</label>
                          <input type="date" id="sender-email" class="form-control" min="2020-10-22" name="deadline" placeholder="Email">
                        </div>
                      </div>
                      <div class="form-group">
                       <div id="card-element" class="form-control">
                        <!-- Elements will create input elements here -->
                      </div>
                      </div>

                      <div id="card-errors" role="alert"></div>
                      <input class="btn btn-common log-btn" type="submit" id="submit" name='btn_submit' value='Buy' />



                         <span class="spinner-border spinner-border-sm " role="status" aria-hidden="true"></span>


                    </form>
                          <div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">

      <h2 class="text-center " style="color:white;background-color: #F96B73;">Payment Confirmation</h4>


    <CENTER><p>Your Payment Has been completed Successfully.....</p>
    <a href="{{route('/')}}"><BUTTON class="btn btn-success mt-3">OK</BUTTON></a></CENTER>
   </div>

</div>

                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- <button id="myBtn">Open Modal</button> -->

     @endsection

     @section('custom-scripts')
     <script src="https://js.stripe.com/v3/"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
     <script type="text/javascript">

      var modal = document.getElementById("myModal");

var span = document.getElementsByClassName("close")[0];

window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}



      // console.log("{{config('app.stripe_public_key')}}");
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
      cardError.innerText = "";

      console.log('responce : '+result.paymentIntent.status);
      if (result.paymentIntent.status === 'succeeded') {


        status = 200;
         var data = new FormData(form)
        axios.get("/update-task-status/{{$task->id}}").then((res)=>{
          console.log("responce status :"+res.status)
        if(res.status ==200){
           modal.style.display = "block";
        }


        });


      }

    }




  })

});


     </script>
     @endsection


