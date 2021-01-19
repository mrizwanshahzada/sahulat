<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>Vendor | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

    @include('frontend.vendor.dashboard.partials._style')

    @yield('custom-styles')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">


 @include('frontend.vendor.dashboard.partials._navebar')

  <!-- Main Sidebar Container -->

  @include('frontend.vendor.dashboard.partials._sidebar')


  <!-- Content Wrapper. Contains page content -->
  @include('frontend.vendor.dashboard.partials.messages')
    @yield('content')
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2020 <a href="http://adminlte.io">SAHULAT</a></strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


@include('frontend.vendor.dashboard.partials._js')

</body>
</html>
