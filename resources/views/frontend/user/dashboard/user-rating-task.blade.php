
@extends('frontend.layouts.app')

@section('title')
  SAHULAT | Home
@endsection
<link href="{{asset('assets/css/feedback.css')}}" rel="stylesheet">
@section('custom-styles')
  <style type="text/css">
    
      .rate-popover {
        color: #c4c4c4;
      }

      .oneStar {
        color: #3d381c;
      }

      .twoStars {
        color: #6d6126;
      }

      .threeStars {

        color: #c2aa36;
      }

      .fourStars {
        color: #e2c327;
      }

      .fiveStars {
        color: #f3cb06;
      }
      #bt{
        /*font-size: 100px;*/
        color: red;
      }
  </style>
@endsection

@section('custom-scripts')
  <script>

    function myFunction()
    {
    alert("Hello! I am an alert box!");
   }
   var $stars;

jQuery(document).ready(function ($) {

  // Custom whitelist to allow for using HTML tags in popover content
  var myDefaultWhiteList = $.fn.tooltip.Constructor.Default.whiteList
  myDefaultWhiteList.textarea = [];
  myDefaultWhiteList.button = [];

  $stars = $('.rate-popover');

  $stars.on('mouseover', function () {
    var index = $(this).attr('data-index');
    markStarsAsActive(index);
  });

  function markStarsAsActive(index) {
    unmarkActive();

    for (var i = 0; i <= index; i++) {
      switch (index) {
        case '0':
          $($stars.get(i)).addClass('oneStar');
          break;
        case '1':
          $($stars.get(i)).addClass('twoStars');
          break;
        case '2':
          $($stars.get(i)).addClass('threeStars');
          break;
        case '3':
          $($stars.get(i)).addClass('fourStars');
          break;
        case '4':
          $($stars.get(i)).addClass('fiveStars');
          break;
      }
    }
  }

  function unmarkActive() {
    $stars.removeClass('oneStar twoStars threeStars fourStars fiveStars');
  }

  $stars.on('click', function () {
    $stars.popover('hide');
  });

  // Submit, you can add some extra custom code here
  // ex. to send the information to the server
  $('#rateMe').on('click', '#voteSubmitButton', function () {
    $stars.popover('hide');
  });

  // Cancel, just close the popover
  $('#rateMe').on('click', '#closePopoverButton', function () {
    $stars.popover('hide');
  });

});

$(function () {
  $('.rate-popover').popover({
    // Append popover to #rateMe to allow handling form inside the popover
    container: '#rateMe',
    // Custom content for popover
    content: `<div class="my-0 py-0"> <textarea type="text" style="font-size: 0.78rem" class="md-textarea form-control py-0" placeholder="Write us what can we improve" rows="3"></textarea> <button id="voteSubmitButton" type="submit" class="btn btn-sm btn-primary">Submit!</button> <button id="closePopoverButton" class="btn btn-flat btn-sm">Close</button>  </div>`
  });
  $('.rate-popover').tooltip();
});


 </script>

@endsection

@section("content")
 <div class="container">
   <div class="row">
     <div class="col-md-12 mb-5">


<center>
        <form method="POST" action="{{route('userSubmitRatingTask',$task)}}">

    <h3 class="rating margn">Please share your feedback about your work satisfaction  </h3>

            @csrf
          <div class="form-group">
            <label class="radio-inline">
              <div class="rating margn text-center"> <input type="radio" name="rating" value="5" id="5"><label for="5">☆</label>
        <input type="radio" name="rating" value="4" id="4"><label for="4">☆</label>
        <input type="radio" name="rating" value="3" id="3"><label for="3">☆</label>
        <input type="radio" name="rating" value="2" id="2"><label for="2">☆</label>
        <input type="radio" name="rating" value="1" id="1"><label for="1">☆</label>
    </div>
          </div>
          <div class="form-group" class="">
            <label for="exampleInputPassword1">Give commnets</label>
            <textarea  class="form-control" id="" placeholder="comments">
            </textarea>
          </div>
          <button type="submit" class="btn btn-primary ">Submit</button>
        </form>
     </div>
   </div>
   
 </div>
  </center>
@endsection

























































