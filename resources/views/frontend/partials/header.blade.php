<!-- Navbar -->
  <div class="header">

        <div class="logo-menu">
          <nav class="navbar navbar-default main-navigation" role="navigation" data-spy="affix" data-offset-top="50">
            <div class="container">
              <!-- Brand and toggle get grouped for better mobile display -->
              <div class="navbar-header">
                <a class="navbar-brand logo" href="{{route('/')}}">
                  <img src="{{ asset('assets/img/logo.png') }}" alt=""></a>
              </div>

              <div class="collapse navbar-collapse" id="navbar">
                 <!-- Start Navigation List -->
                <ul class="nav navbar-nav">
                  <li>
                    <a href="{{ route('/') }}">
                    Home
                    </a>
                  </li>
                  <li>
                    <a href="{{ route('services') }}">
                    Services
                    </a>
                  </li>
                  <li>
                    <a href="{{ route('about') }}">
                    About
                    </a>
                  </li>
                  <li>
                    <a href="{{ route('contact') }}">
                    Contact
                    </a>
                  </li>
                </ul>

                <ul class="nav navbar-nav navbar-right float-right">

                    @guest
                        <li class="left"><a href="{{ route('registerVendor') }}"><i class="ti-pencil-alt"></i> Work With Us </a></li>
                        <li class="right"><a href="{{ route('login') }}"><i class="ti-lock"></i> Log In </a></li>
                    @endguest

                    @auth
                        <li>
                          <a><i class="ti-lock"></i> My Account </a>
                          <ul>
                            <li>
                              <a href="{{ route(strtolower(auth::user()->role).'Dashboard') }}">
                              My Dashboard
                              </a>
                            </li>
                            <li>
                              <a href="{{ route(strtolower(auth::user()->role).'Profile') }}">
                              My Profile
                              </a>
                            </li>
                            <li>
                              <a href="{{ route('logout') }}">
                              Logout
                              </a>
                            </li>
                          </ul>
                        </li>
                    @endauth

                </ul>

            <!-- Search Box -->
                  <form method="get" action="{{ route('search') }}">
                      <ul class="nav navbar-nav navbar-right float-right">
                          <li style="margin-right: 0;">
                            <input style="height: 42px; margin-right: 0;" id="navSearchInput" class="form-control" name="keywords" type="text" placeholder="Search a Service">
                          </li>
                          <li style="margin-left: 0;">
                            <button style="height: 42px; padding: 15%; margin-left: 0;" type="submit" class="btn btn-search-icon"><i class="ti-search"></i></button>
                          </li>
                      </ul>
                  </form>

              </div>
            </div>
            <!-- Mobile Menu Start -->
            <ul class="wpb-mobile-menu">
              <li>
                <a href="{{route('/')}}">Home</a>
              </li>
              <li>
                <a class="active" href="services">Services</a>
              </li>
              <li>
                <a href="contact">Contact</a>
              </li>
              <li>
                <a href="about">About</a>
              </li>

              <li class="form-control" type="text" style="height: 40px; margin-top: 0; padding-top: 0;"><input style="width: 79%; height: 40px; margin-top: 0;" placeholder="Search a Service">
                <button type="button" class="btn btn-search-icon" style="width: 20%; height: 40px; padding: 1.5%; "><i class="ti-search"></i></button></li>
              <li class="btn-m"><a href="post-job"><i class="ti-pencil-alt"></i> Post A Job</a></li>
              <li class="btn-m">
                <a href="my-account">
                  <i class="ti-lock"></i>  Log In</a>
              </li>
            </ul>
            <!-- Mobile Menu End -->
          </nav>
      </div>
      <!-- End of Navbar -->


  </div>

