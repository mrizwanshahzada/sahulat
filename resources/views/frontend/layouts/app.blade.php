<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
      <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<title> @yield('title') </title>
	@include('frontend.partials.styles')
	@yield('custom-styles')
  @show
</head>
<body>
  @include('frontend.partials.header')
  <!-- @include('frontend.partials.messages') -->
  @yield('content')


  @include('frontend.partials.footer')

  @include('frontend.partials.script')
  @yield('custom-scripts')
  @show
</body>
</html>
