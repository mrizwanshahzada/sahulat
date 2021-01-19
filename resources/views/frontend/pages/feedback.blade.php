@extends('frontend.layouts.app')
@extends('frontend.partials.styles')
@extends('frontend.partials.script')
<link href="{{asset('assets/css/feedback.css')}}" rel="stylesheet">

@section('title')
    Feedback
@endsection
@section("content")
<div class="margn2">.</div>
    <h3 class="rating margn">Please share your feedback about your work satisfaction  </h3>
    <div class="rating mt-5">

    </div>
    <div class="rating margn"> <input type="radio" name="rating" value="5" id="5"><label for="5">☆</label>
        <input type="radio" name="rating" value="4" id="4"><label for="4">☆</label>
        <input type="radio" name="rating" value="3" id="3"><label for="3">☆</label>
        <input type="radio" name="rating" value="2" id="2"><label for="2">☆</label>
        <input type="radio" name="rating" value="1" id="1"><label for="1">☆</label>
    </div>
<div class="text-center margn"><input type="submit" value="submit"> </div>
<div class="margn2">.</div>
 
@endsection



