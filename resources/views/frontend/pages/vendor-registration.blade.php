@extends('frontend.layouts.app')

@section('title')
    SAHULAT | Vendor Registration
@endsection

@section('custom-styles')
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            background-color: #f1f1f1;
        }

        #regForm {
            background-color: #ffffff;
            margin: 100px auto;
            font-family: Raleway;
            padding: 40px;
            width: 70%;
            min-width: 300px;
        }

        h1 {
            text-align: center;
        }

        input {
            padding: 10px;
            width: 100%;
            font-size: 17px;
            font-family: Raleway;
            border: 1px solid #aaaaaa;
        }

        /* Mark input boxes that gets an error on validation: */
        input.invalid {
            background-color: #ffdddd;
        }

        /* Hide all steps by default: */
        .tab {
            display: none;
        }

        button {
            background-color: #4CAF50;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            font-size: 17px;
            font-family: Raleway;
            cursor: pointer;
        }

        button:hover {
            opacity: 0.8;
        }

        #prevBtn {
            background-color: #bbbbbb;
        }

        /* Make circles that indicate the steps of the form: */
        .step {
            height: 15px;
            width: 15px;
            margin: 0 2px;
            background-color: #bbbbbb;
            border: none;
            border-radius: 50%;
            display: inline-block;
            opacity: 0.5;
        }

        .step.active {
            opacity: 1;
        }

        /* Mark the steps that are finished and valid: */
        .step.finish {
            background-color: #4CAF50;
        }
    </style>
    <style>


        .error-email { color: red; display: none;}
        .error-phone { color: red; display: none;}
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
            /*padding: 20px;*/
            border: 1px solid #888;
            width: 80%;
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

        #map {
            height: 100%;
        }

        .dialog-content {
            height: 100%;
        }

        /* Optional: Makes the sample page fill the window. */
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        #description {
            font-family: Roboto;
            font-size: 15px;
            font-weight: 300;
        }

        #infowindow-content .title {
            font-weight: bold;
        }

        #infowindow-content {
            display: none;
        }

        #map #infowindow-content {
            display: inline;
        }

        .pac-card {
            margin: 10px 10px 0 0;
            border-radius: 2px 0 0 2px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            outline: none;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
            background-color: #fff;
            font-family: Roboto;
        }

        #pac-container {
            padding-bottom: 12px;
            margin-right: 12px;
        }

        .pac-controls {
            display: inline-block;
            padding: 5px 11px;
        }

        .pac-controls label {
            font-family: Roboto;
            font-size: 13px;
            font-weight: 300;
        }

        #pac-input {
            background-color: #fff;
            font-family: Roboto;
            font-size: 15px;
            font-weight: 300;
            margin-left: 12px;
            padding: 0 11px 0 13px;
            text-overflow: ellipsis;
            width: 400px;
        }

        #pac-input:focus {
            border-color: #4d90fe;
        }

        #title {
            color: #fff;
            background-color: #4d90fe;
            font-size: 25px;
            font-weight: 500;
            padding: 6px 12px;
        }

        #target {
            width: 345px;
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
                        <h2 class="product-title">Vendor Registration</h2>
                        <ol class="breadcrumb">
                            <li><a href="#"><i class="ti-home"></i> Home</a></li>
                            <li class="current">Vendor Registration</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Page Header End -->
    {{--      asdf asdf --}}
    <form id="regForm" method="POST" action="{{ route('registerVendor') }}" role="form" class="login-form" enctype="multipart/form-data">
        @csrf
        <!-- One "tab" for each step in the form: -->
        <div class="tab">
            <div class="divider"><h3>Enter Your Personal Details</h3></div>
            <div class="form-group">
                <div class="input-icon">
                    <i class="ti-user"></i>
                    <input type="text" id="" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name ) }}" placeholder="Full Name">
                </div>
                @error('name')
                <span class="invalid-feedback text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <div class="input-icon">
                    <i class="ti-user"></i>
                    <input type="number" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $user->phone ) }}" name="phone" placeholder="Phone Number">
                </div>


                @error('phone')
                <span class="invalid-feedback text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <!-- <p class="error-phone" id="error-phone">Phone already exists</p> -->
            </div>
            <div class="form-group">
                <div class="input-icon">
                    <i class="ti-user"></i>
                    <input type="text" id="" class="form-control" name="address" placeholder="Address" value="{{ old('email', $user->address) }}">
                </div>
            </div>
            <div class="form-group">
                <div class="search-category-container">
                    <label class="styled-select">
                        <select name="gender" class="dropdown-product selectpicker form-control @error('gender') is-invalid @enderror">
                            <option>Male</option>
                            <option>Female</option>
                        </select>
                    </label>
                </div>
                @error('gender')
                <span class="invalid-feedback text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="tab">
            <div class="divider"><h3>Enter Login & Account Credentials</h3></div>
            <div class="form-group">
                <div class="input-icon">
                    <i class="ti-email"></i>
                    <input type="text" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email ) }}" name="email" placeholder="Email">
                </div>
                @error('email')
                <span class="invalid-feedback text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <!-- <p class="error-email" id="error-email">Email already exists</p> -->
            </div>

            <div class="form-group">
                <div class="input-icon">
                    <i class="ti-lock"></i>
                    <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                </div>
                @error('password')
                <span class="invalid-feedback text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <div class="input-icon">
                    <i class="ti-lock"></i>
                    <input type="password" name="confirm-password" class="form-control @error('name') is-invalid @enderror" placeholder="Repeat Password">
                </div>
                @error('confirm-password')
                <span class="invalid-feedback text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <div class="input-icon">
                    <i class="ti-lock"></i>
                    <input type="text" name="account_number" class="form-control @error('account_number') is-invalid @enderror" placeholder="Enter Account Number">
                </div>
                @error('account_number')
                <span class="invalid-feedback text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <div class="button-group">
                    <div class="action-buttons">
                        <div class="upload-button">
                            <button class="btn btn-common">Add Profile Photo</button>
                            <input id="cover_img_file" type="file" name="profile_photo">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab">
            <div class="divider"><h3>Enter Your Company's Details</h3></div>
            <div class="form-group">
                <label class="control-label" for="textarea">Company Name</label>
                <input name="company_name" type="text" class="form-control" value="{{ old('company_name', $vendor->company_name ) }}"  placeholder="Company Name">
            </div>
            <div class="form-group">
                <label class="control-label" for="textarea">Location</label>
                <input name="business_location"
                       type="text" class="form-control" value="{{ old('business_location', $vendor->business_location ) }}"  placeholder="Business Location">
                @error('business_location')
                <span class="invalid-feedback text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label class="control-label btn btn-common" id="myBtn" for="textarea">Select Your Bussiness Location</label>
                <input name="lat" id="lat"
                       readonly=""   class="form-control" value="{{ old('lat', $user->latitude ) }}" type="Hidden"  placeholder="Business Location">
                <input name="long" id="long"
                       readonly=""   class="form-control" value="{{ old('long', $user->longitude ) }}" type="Hidden"  placeholder="Business Location">
                @error('business_location')
                <span class="invalid-feedback text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="tab">
            <div class="divider"><h3>Enter Your Service Details</h3></div>
            <div class="form-group">
                <label class="control-label" for="textarea">Service Title</label>
                <input name="title" type="text" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $service->title ) }}" placeholder="Service Title">
                @error('title')
                <span class="invalid-feedback text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label class="control-label" for="textarea">Service Description</label>
                <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="7">{{ old('description', $service->description ) }}</textarea>
                @error('description')
                <span class="invalid-feedback text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <div class="button-group">
                    <div class="action-buttons">
                        <div class="upload-button">
                            <button class="btn btn-common">Add Service image</button>
                            <input id="cover_img_file" type="file" name="service_image">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label" for="textarea">Service Charges</label>
                <input name="charges" type="text" class="form-control @error('charges') is-invalid @enderror" value="{{ old('charges', $service->charges ) }}"  placeholder="Service Charges">
                @error('charges')
                <span class="invalid-feedback text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label class="control-label" for="textarea">Requirements</label>
                <input name="requirements" value="" type="text" class="form-control"  placeholder="E.g. NIC, Passport">
            </div>

        </div>
        <div style="overflow:auto;">
            <div style="float:right;">
                <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
            </div>
        </div>
        <!-- Circles which indicates the steps of the form: -->
        <div style="text-align:center;margin-top:40px;">
            <span class="step"></span>
            <span class="step"></span>
            <span class="step"></span>
            <span class="step"></span>
        </div>
    </form>
    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content dialog-content" >
            <!--   <span class="close">&times;</span>
              <p>Some text in the Modal..</p> -->

            <input
                id="pac-input"
                class="controls form-control pt-1"
                type="text"
                placeholder="Search Box"
            />
            <div id="map" class="container h-100 w-100" ></div>

        </div>

    </div>



@endsection
@section('custom-scripts')

    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script
        src="//maps.googleapis.com/maps/api/js?key=AIzaSyA1uIgJLlFocMlwcu8b3wKPKkdT2mWV3AU&callback=initAutocomplete&libraries=places&v=weekly"
        defer
    ></script>

    <script src="https://js.arcgis.com/4.17/"></script>
    <script>

        var setMarker = true;
        var marker;

        function initAutocomplete() {

            const map = new google.maps.Map(document.getElementById("map"), {
                center: { lat: -33.8688, lng: 151.2195 },
                zoom: 13,
                mapTypeId: "roadmap",
            });
            // Create the search box and link it to the UI element.
            const input = document.getElementById("pac-input");
            const searchBox = new google.maps.places.SearchBox(input);
            map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
            // Bias the SearchBox results towards current map's viewport.
            map.addListener("bounds_changed", () => {
                searchBox.setBounds(map.getBounds());
            });
            let markers = [];



            map.addListener("click", (mapsMouseEvent) => {
                // Close the current InfoWindow.
                // modal.style.display = "none";
                var currentP;
                // infoWindow.close();
                // Create a new InfoWindow.
                var infoWindow = new google.maps.InfoWindow({
                    position: mapsMouseEvent.latLng,

                });

                placeMarker(mapsMouseEvent.latLng)

                infoWindow.setContent(
                    JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2)
                );
                // infoWindow.open(map);
                var data = JSON.parse(infoWindow.content);
                var lat = data['lat'];
                var long =data['lng'];
                document.getElementById('lat').value = lat;
                document.getElementById('long').value = long;

                modal.style.display = "none";


            });





            function placeMarker(location) {
                if(setMarker){
                    marker = new google.maps.Marker({
                        position: location,
                        map: map
                    });
                    setMarker = false;
                }
                else
                    marker.setPosition(location);
            }



            // [START maps_places_searchbox_getplaces]
            // Listen for the event fired when the user selects a prediction and retrieve
            // more details for that place.
            searchBox.addListener("places_changed", () => {
                const places = searchBox.getPlaces();

                if (places.length == 0) {
                    return;
                }
                // Clear out the old markers.
                markers.forEach((marker) => {
                    marker.setMap(null);
                });
                markers = [];
                // For each place, get the icon, name and location.
                const bounds = new google.maps.LatLngBounds();
                places.forEach((place) => {
                    if (!place.geometry) {
                        console.log("Returned place contains no geometry");
                        return;
                    }
                    const icon = {
                        url: place.icon,
                        size: new google.maps.Size(71, 71),
                        origin: new google.maps.Point(0, 0),
                        anchor: new google.maps.Point(17, 34),
                        scaledSize: new google.maps.Size(25, 25),
                    };
                    // Create a marker for each place.
                    markers.push(
                        new google.maps.Marker({
                            map,
                            icon,
                            title: place.name,
                            position: place.geometry.location,
                        })
                    );

                    if (place.geometry.viewport) {
                        // Only geocodes have viewport.
                        bounds.union(place.geometry.viewport);
                    } else {
                        bounds.extend(place.geometry.location);
                    }
                });
                map.fitBounds(bounds);
            });
            // [END maps_places_searchbox_getplaces]
        }
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the button that opens the modal
        var btn = document.getElementById("myBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }




        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target != modal) {
                modal.style.display = "none";
            }
        }




        $('#email').blur(function () {
            $.post('{{ route('checkEmailAvailability') }}', {email:$("#email").val(), _token:'{{ csrf_token() }}'}, function (result) {
                if(result === 'not available'){
                    $('#error-email').css('display','block');
                }else{
                    $('#error-email').css('display','none');
                }
            });
        });

        $('#phone').blur(function () {
            $.post('{{ route('checkPhoneAvailability') }}', {phone:$("#phone").val(), _token:'{{ csrf_token() }}'}, function (result) {
                if(result === 'not available'){
                    $('#error-phone').css('display','block');
                }else{
                    $('#error-phone').css('display','none');
                }
            });
        });
    </script>
    <script>
        var currentTab = 0; // Current tab is set to be the first tab (0)
        showTab(currentTab); // Display the current tab

        function showTab(n) {
            // This function will display the specified tab of the form...
            var x = document.getElementsByClassName("tab");
            x[n].style.display = "block";
            //... and fix the Previous/Next buttons:
            if (n == 0) {
                document.getElementById("prevBtn").style.display = "none";
            } else {
                document.getElementById("prevBtn").style.display = "inline";
            }
            if (n == (x.length - 1)) {
                document.getElementById("nextBtn").innerHTML = "Submit";
            } else {
                document.getElementById("nextBtn").innerHTML = "Next";
            }
            //... and run a function that will display the correct step indicator:
            fixStepIndicator(n)
        }

        function nextPrev(n) {
            // This function will figure out which tab to display
            var x = document.getElementsByClassName("tab");
            // Exit the function if any field in the current tab is invalid:
            if (n == 1 && !validateForm()) return false;
            // Hide the current tab:
            x[currentTab].style.display = "none";
            // Increase or decrease the current tab by 1:
            currentTab = currentTab + n;
            // if you have reached the end of the form...
            if (currentTab >= x.length) {
                // ... the form gets submitted:
                document.getElementById("regForm").submit();
                return false;
            }
            // Otherwise, display the correct tab:
            showTab(currentTab);
        }

        function validateForm() {
            // This function deals with validation of the form fields
            var x, y, i, valid = true;
            x = document.getElementsByClassName("tab");
            y = x[currentTab].getElementsByTagName("input");
            // A loop that checks every input field in the current tab:
            for (i = 0; i < y.length; i++) {
                // If a field is empty...
                if (y[i].value == "") {
                    // add an "invalid" class to the field:
                    y[i].className += " invalid";
                    // and set the current valid status to false
                    valid = false;
                }
            }
            // If the valid status is true, mark the step as finished and valid:
            if (valid) {
                document.getElementsByClassName("step")[currentTab].className += " finish";
            }
            return valid; // return the valid status
        }

        function fixStepIndicator(n) {
            // This function removes the "active" class of all steps...
            var i, x = document.getElementsByClassName("step");
            for (i = 0; i < x.length; i++) {
                x[i].className = x[i].className.replace(" active", "");
            }
            //... and adds the "active" class on the current step:
            x[n].className += " active";
        }
    </script>
@endsection






