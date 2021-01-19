@extends('frontend.layouts.app')

@section('title')
    SAHULAT | Contact page
@endsection

@section('custom-styles')
    <!-- Google Maps -->


@endsection

@section('content')

    <!-- Start Map Section -->
    <div id='map' style='width: 80%; height: 400px; margin: 5% auto 0 auto;'></div>
    <!-- End Map Section -->

    <!-- Start Contact Us Section -->
    <section id="content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="medium-title">
                        Contact Us
                    </h2>
                    <div class="information">
                        <div class="contact-datails">
                            <div class="icon">
                                <i class="ti-location-pin"></i>
                            </div>
                            <div class="info">
                                <h3>Address</h3>
                                <span class="detail">Virtual University of Pakistan
                      M.A. Jinnah Campus, Defence Road,
                      Off Raiwind Road,
                      Lahore, Pakistan.</span>
                                <span class="datail">Customer Center: NO.130-45 Streen Name- City, Country</span>
                            </div>
                        </div>
                        <div class="contact-datails">
                            <div class="icon">
                                <i class="ti-mobile"></i>
                            </div>
                            <div class="info">
                                <h3>Phone Numbers</h3>
                                <span class="detail">Main Office: +92 42 99200604</span>
                                <span class="datail">Customer Supprort: +92 42 99202174 </span>
                            </div>
                        </div>
                        <div class="contact-datails">
                            <div class="icon">
                                <i class="ti-location-arrow"></i>
                            </div>
                            <div class="info">
                                <h3>Email Address</h3>
                                <span class="detail">Customer
                    Support: support.aaou2019@vu.edu.pk</span>
                                <span class="detail">Technical Support: support.aaou2019@vu.edu.pk</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Contact Us Section  -->






@endsection



@section('custom-scripts')
    <!-- Google Maps API -->

    <script src='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.css' rel='stylesheet' />
    <script>
        mapboxgl.accessToken = 'pk.eyJ1Ijoic2FhZHNoYWhlZW4xMTIyMzMiLCJhIjoiY2tmejkzNGhsMjhkcjJ6c3ZnMmY2dmdhciJ9.he1jbTXQ5lROOv9TAu6onQ';
        var map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v11', // stylesheet location
            center: [74.3294602, 31.5507198], // starting position [lng, lat]
            zoom: 12 // starting zoom
        });

        var marker = new mapboxgl.Marker()
            .setLngLat([74.3294602, 31.5507198])
            .addTo(map);
    </script>


@endsection
