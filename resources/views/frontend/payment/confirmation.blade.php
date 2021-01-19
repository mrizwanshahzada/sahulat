@extends('frontend.layouts.app')

@section('title')
   confirmation
@endsection

@section("content")
<center>

<div class="w-75" style="width:40% !important;">

<div style="margin-top:40px;color:green;"><h3>Your Payment is completed successfully</h3></<div>
 </div>
<h4 style="margin-top:20px;"> Your payment detail is as follows </h4>

<div class="row bg-dark mt-5" style="margin-top:40px;">
<div class="col-md-5 col-offset-1" style="">
<h5 style="margin-top:15px;"> Service Title : </h5>
<h5 style="margin-top:15px;"> Vendor Name :</h5>
<h5 style="margin-top:15px;"> Deadline : </h5>
<h5 style="margin-top:15px;"> Paid Ammount :S </h5>
<input class="btn btn-primary"  style="margin-top:40px;" type="submit" value="Go To dashboard">
</div>

<div class="col-md-5 col-offset-1" style=""><h5 style="margin-top:15px;"> Service Title : </h5>
<h5 style="margin-top:15px;"> Vendor Name :</h5>
<h5 style="margin-top:15px;"> Deadline : </h5>
<h5 style="margin-top:15px;"> Paid Ammount :S </h5>
<a href="{{Route('/')}}" class="btn btn-primary" style="margin-top:40px;">Go To Home Page</a>


</div>
</div>




</div>

</center>
<br>
<br>
@endsection





