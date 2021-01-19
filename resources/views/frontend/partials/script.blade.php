    <script type="text/javascript" src="{{ asset('assets/js/jquery-min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/material.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/material-kit.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/color-switcher.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/jquery.parallax.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/jquery.slicknav.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/main.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/jquery.counterup.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/waypoints.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/jasny-bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/bootstrap-select.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/form-validator.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/contact-form-script.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/jquery.themepunch.revolution.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/jquery.themepunch.tools.min.js') }}"></script>
    <script src="https://js.pusher.com/6.0/pusher.min.js"></script>
    <script type="text/javascript" src="{{asset('assets/js/chat.js')}}"></script>
    <script type="text/javascript" src="sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Jquery UI -->
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <script type="text/javascript">
        $("#navSearchInput").autocomplete({
            source: '{{ route('suggestSearch') }}',
            minlength: 1,
        });
         $("#findSearchInput").autocomplete({
            source: '{{ route('suggestSearch') }}',
            minlength: 1,


        });
    </script>



