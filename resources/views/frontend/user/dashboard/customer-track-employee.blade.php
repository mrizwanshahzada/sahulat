
@extends('frontend.layouts.app')
@section('title')
    SAHULAT | Search Result
@endsection

@section('custom-styles')
   <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.css' rel='stylesheet ' />

    <style>

	body { margin: 0; padding: 0; }
	
	  
   </style>
@endsection
	@section('content')
	  
         <div id='map' style='width: 100%; height: 100vh;'></div>
         <input type="text" class="text-hide" id="taskId" value="{{$task->id}}">
         @if($task->employee_id != NULL)
	       
			 <input type="hidden" name="coords" id="coords" value="{{$task->employee->user->longitude}},{{$task->employee->user->latitude}}">
         @endif
           
    
      @section('custom-scripts')
       <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.js'></script>
		<script type="module">
     
     // authorization of map
       var taskId=document.getElementById('taskId').value;

     window.Echo.channel("22").listen('SendPosition', (e) => {
                 var id=e._id;
                 
                 if(id != taskId){

                 	$('#map').hide()
                 }               	
            });
     // end of map authorization


        // 1st part of map
			// var id = document.querySelector('#rider-id').value;
			let coords = document.querySelector('#coords').value;
			
			// 31.549881, 74.328059
			let center = coords.split(',');
			mapboxgl.accessToken = 'pk.eyJ1Ijoic3VubnlzaG91a2F0IiwiYSI6ImNrZ3R2aWFrbTB5cHUyemt5dmhqeG53anIifQ.HMwushOZZCjrJoqCuGVrog';
			var map = new mapboxgl.Map({
			container: 'map',
			style: 'mapbox://styles/mapbox/streets-v10',
			center: [center[0],center[1]], // starting position
			zoom: 11
			});

			// set the bounds of the map
			// var bounds = [[74.3247936,31.5461822], [74.328059,31.549881]];
			// map.setMaxBounds(bounds);

			// initialize the map canvas to interact with later
			// var canvas = map.getCanvasContainer();

			// an arbitrary start will always be the same
			// only the end or destination will change
			var start = [center[0],center[1]];

			// this is where the code for the next step will go

			// create a function to make a directions request
			//2nd part of getroute function first this function get first cordinates of database
			function getRoute(end) {
			// make a directions request using cycling profile
			// an arbitrary start will always be the same
			// only the end or destination will change
			var start = [center[0],center[1]];
			var url = 'https://api.mapbox.com/directions/v5/mapbox/cycling/' + start[0] + ',' + start[1] + ';' + end[0] + ',' + end[1] + '?steps=true&geometries=geojson&access_token=' + mapboxgl.accessToken;

			// make an XHR request https://developer.mozilla.org/en-US/docs/Web/API/XMLHttpRequest
			var req = new XMLHttpRequest();
			req.open('GET', url, true);
			req.onload = function() {
			var json = JSON.parse(req.response);
			var data = json.routes[0];
			var route = data.geometry.coordinates;
			var geojson = {
			type: 'Feature',
			properties: {},
			geometry: {
			type: 'LineString',
			coordinates: route
			}
			};
			// if the route already exists on the map, reset it using setData
			if (map.getSource('route')) {
			map.getSource('route').setData(geojson);
			console.log(geojson);
			} else { // otherwise, make a new request
			map.addLayer({
			id: 'route',
			type: 'line',
			source: {
			type: 'geojson',
			data: {
			type: 'Feature',
			properties: {},
			geometry: {
			type: 'LineString',
			coordinates: geojson
			}
			}
			},
			layout: {
			'line-join': 'round',
			'line-cap': 'round'
			},
			paint: {
			'line-color': '#3887be',
			'line-width': 5,
			'line-opacity': 0.75
			}
			});
			}
			// add turn instructions here at the end
			};
			req.send();
			}
            
            //3rd part of map load  in this getRoute function is call first cordinates of database and next time brobrodcasting
			map.on('load', function() {
			// make an initial directions request that
			// starts and ends at the same location
			getRoute(start);

			// Add starting point to the map
			map.addLayer({
			id: 'point',
			type: 'circle',
			source: {
			type: 'geojson',
			data: {
			type: 'FeatureCollection',
			features: [{
			type: 'Feature',
			properties: {},
			geometry: {
			type: 'Point',
			coordinates: start
			}
			}
			]
			}
			},
			paint: {
			'circle-radius': 10,
			'circle-color': '#3887be'
			}
			});
			// this is where the code from the next step will go
			});

			window.Echo.channel("22").listen('SendPosition', (e) => {
			console.log(e._longitude + e._latitude);
			// console.log(var id=e._id);

			// })
			//
			// map.on('load', function(e) {
			// 74.345740,31.508605 e._lng,e._lat 31.549881, 74.328059s
			var coordsObj = [74.345740,31.508605];
			// canvas.style.cursor = '';
			var coords = Object.keys(coordsObj).map(function(key) {
			return coordsObj[key];
			});
			var end = {
			type: 'FeatureCollection',
			features: [{
			type: 'Feature',
			properties: {},
			geometry: {
			type: 'Point',
			coordinates: coords
			}
			}
			]
			};
			if (map.getLayer('end')) {
			map.getSource('end').setData(end);
			} else {
			map.addLayer({
			id: 'end',
			type: 'circle',
			source: {
			type: 'geojson',
			data: {
			type: 'FeatureCollection',
			features: [{
			type: 'Feature',
			properties: {},
			geometry: {
			type: 'Point',
			coordinates: coords
			}
			}]
			}
			},
			paint: {
			'circle-radius': 10,
			'circle-color': '#f30'
			}
			});
			}
			getRoute(coords);
			});

		    </script>
             

          @endsection
     @endsection







