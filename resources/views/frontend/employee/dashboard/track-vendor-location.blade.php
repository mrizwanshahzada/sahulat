@extends('frontend.employee.layouts.app')

@section('title')
  SAHULAT | Vendor Location
@endsection

@section('custom-styles')
    <link href='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.css' rel='stylesheet' />
@endsection

@section('custom-scripts')

  <script src='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.js'></script>
<script>
	// TO MAKE THE MAP APPEAR YOU MUST
	// ADD YOUR ACCESS TOKEN FROM
	// https://account.mapbox.com
	mapboxgl.accessToken = 'pk.eyJ1Ijoic2FhZHNoYWhlZW4xMTIyMzMiLCJhIjoiY2tmejkzNGhsMjhkcjJ6c3ZnMmY2dmdhciJ9.he1jbTXQ5lROOv9TAu6onQ';
   var map = new mapboxgl.Map({
	container: 'map',
	style: 'mapbox://styles/mapbox/streets-v11',
	center: ['{{$long}}', '{{$lat}}'], // starting position [lng, lat]
	zoom: 8
	});
	 
	var marker = new mapboxgl.Marker()
	.setLngLat(['{{$long}}', '{{$lat}}'])
	.addTo(map);

</script>
@endsection

@section("content")
  <div class="container m-5">
    <div id='map' style='width: 90%; height: 400px; margin-left: 20%;'></div>
 </div>

@endsection
