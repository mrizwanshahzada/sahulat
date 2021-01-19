@extends('frontend.layouts.app')

@section('title')
  SAHULAT | Add Service
@endsection

@section('content')

      <!-- Page Header Start -->
      <div class="page-header" style="background: {{ url(assets/img/banner1.jpg )}}">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="breadcrumb-wrapper">
                <h2 class="product-title">Add a Service</h2>
                <ol class="breadcrumb">
                  <li><a href="#"><i class="ti-home"></i> Home</a></li>
                  <li class="current">Add Services</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Page Header End -->

    <!-- Content section Start -->
    <section id="content">
      <div class="container">
        <div class="row">
          <div class="col-md-9 col-md-offset-2">
            <div class="page-ads box">
              <div class="post-header">
                <p>Already have an account? <a href="my-account.html">Click here to login</a></p>
              </div>
              <form class="form-ad">
                <div class="divider"><h3>Add Service</h3></div>
                <div class="form-group">
                  <label class="control-label" for="textarea">Service Title</label>
                  <input type="text" class="form-control" placeholder="Name">
                </div>
                <div class="form-group">
                  <label class="control-label" for="textarea"></label>
                  <label class="control-label" for="textarea">Frequency</label>
                  <input type="text" class="form-control"  >
                </div>
                <div class="form-group">
                  <label class="control-label" for="textarea">Service Charges</label>
                  <input type="text" class="form-control"  placeholder="">
                </div>
                <div class="form-group">
                  <label class="control-label" for="textarea">Location</label>
                  <input type="text" class="form-control"  placeholder="Location, e.g">
                </div>



                <div class="form-group">
                  <div class="button-group">
                    <div class="action-buttons">
                      <div class="upload-button">
                        <button class="btn btn-common">Add Service image</button>
                        <input id="cover_img_file" type="file">
                      </div>
                    </div>
                  </div>
                </div>



                <div class="form-group">
                  <label class="control-label" for="textarea">Description</label>
                  <textarea class="form-control" rows="7"></textarea>
                </div>


                <div class="form-group">
                  <label class="control-label" for="textarea">Company Name</label>
                  <input type="text" class="form-control"  placeholder="Company name">
                </div>

              </form>
              <a href="resume.html" class="btn btn-common">Save</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Content section End -->



      <!-- Go To Top Link -->
      <a href="#" class="back-to-top">
        <i class="ti-arrow-up"></i>
      </a>

    @section('custom-script')
    <!-- Main JS  -->
    <script type="text/javascript" src="assets/js/jquery-min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/material.min.js"></script>
    <script type="text/javascript" src="assets/js/material-kit.js"></script>
    <script type="text/javascript" src="assets/js/color-switcher.js"></script>
    <script type="text/javascript" src="assets/js/jquery.parallax.js"></script>
    <script type="text/javascript" src="assets/js/owl.carousel.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery.slicknav.js"></script>
    <script type="text/javascript" src="assets/js/main.js"></script>
    <script type="text/javascript" src="assets/js/jquery.counterup.min.js"></script>
    <script type="text/javascript" src="assets/js/waypoints.min.js"></script>
    <script type="text/javascript" src="assets/js/jasny-bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap-select.min.js"></script>
    <script type="text/javascript" src="assets/js/form-validator.min.js"></script>
    <script type="text/javascript" src="assets/js/contact-form-script.js"></script>
    <script type="text/javascript" src="assets/js/jquery.themepunch.revolution.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery.themepunch.tools.min.js"></script>
    <script type="text/javascript" src="assets/js/summernote.js"></script>

    <script>
      $(document).ready(function() {
          $('#summernote').summernote({
            height: 250,                 // set editor height
            minHeight: null,             // set minimum height of editor
            maxHeight: null,             // set maximum height of editor
            focus: true                  // set focus to editable area after initializing summernote
          });
      });
    </script>

    @endsection

@endsection
