{{-- <!DOCTYPE html> --}}
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin | @yield('title')</title>
    <!-- base:css -->
    <link rel="stylesheet" href="{{asset('vendors/typicons.font/font/typicons.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/css/vendor.bundle.base.css')}}">
    <link rel="stylesheet" href="{{asset('css/vertical-layout-light/style.css')}}">
    <style>
      .sidebar .nav .nav-item.active > .nav-link {
          background: none;
      }
      .sidebar .nav .nav-item.active-menu > .nav-link {
          background: #414147;
      }
      .bg-ass {
        background-color: #E8EFF9;
      }
    </style>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row navbar-success">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center cbg-dark">
          <a class="navbar-brand brand-logo" href="index.html"><img src="images/logo.svg" alt="logo"/></a>
          <a class="navbar-brand brand-logo-mini" href="index.html"><img src="" alt="logo"/></a>
          <button class="navbar-toggler navbar-toggler text-light align-self-center d-none d-lg-flex" type="button" data-toggle="minimize">
            <span class="typcn typcn-th-menu"></span>
          </button>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
         
          <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
              <a class="nav-link dropdown-toggle  pl-0 pr-0" href="#" data-toggle="dropdown" id="profileDropdown">
                <i class="typcn typcn-user-outline mr-0"></i>
                <span class="nav-profile-name">{{auth()->user()->name}}</span>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                
                <a class="dropdown-item" href="{{route('logout')}}">
                <i class="typcn typcn-power text-primary"></i>
                Logout
                </a>
              </div>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="typcn typcn-th-menu"></span>
          </button>
        </div>
      </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">
            <li class="nav-item">
                <p class="sidebar-menu-title">Dash menu</p>
            </li>
            <li class="nav-item {{request()->is('dashboard')?'active-menu':''}}">
                <a class="nav-link" href="{{route('dashboard')}}">
                <i class="typcn typcn-device-desktop menu-icon"></i>
                <span class="menu-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item {{request()->is(['ticket','view*'])?'active-menu':''}}">
                <a class="nav-link" href="{{route('ticket')}}">
                <i class="typcn typcn-briefcase menu-icon"></i>
                <span class="menu-title">Manage Tickets</span>
                </a>
            </li>
            @if (auth()->user()->role == 2)  
            <li class="nav-item {{request()->is('open-ticket')?'active-menu':''}}">
                <a class="nav-link" href="{{route('open-ticket')}}">
                <i class="typcn typcn-briefcase menu-icon"></i>
                <span class="menu-title">Open Ticket</span>
                </a>
            </li>
            @endif
            </ul>
           
        </nav>
        <!-- partial -->
        <div class="main-panel">
          <div class="">
            <div class="px-4 pt-3 bg-ass">
              @if ($errors->any())
              <div class="alert alert-danger m-0">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
              @endif
              @if (session('success') || session('error'))
                <div class="alert alert-{{session('success')?'success':'danger'}} mb-0 p-3">
                    {{ session('success')??session('error') }}
                </div>
              @endif
              
            </div>
          </div>
            @yield('content')
          <!-- content-wrapper ends -->
          
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- base:js -->
    <script src="{{asset('vendors/js/vendor.bundle.base.js')}}"></script>
    <!-- endinject -->
    <!-- inject:js -->
    <script src="{{asset('js/off-canvas.js')}}"></script>
    <script src="{{asset('js/hoverable-collapse.js')}}"></script>
    <script src="{{asset('js/template.js')}}"></script>
    <script src="{{asset('js/settings.js')}}"></script>
    <script src="{{asset('js/todolist.js')}}"></script>
    <!-- endinject -->
    <!-- plugin js for this page -->
    <script src="{{asset('vendors/progressbar.js/progressbar.min.js')}}"></script>
    <script src="{{asset('vendors/chart.js/Chart.min.js')}}"></script>
    <!-- Custom js for this page-->
    <script src="{{asset('js/dashboard.js')}}"></script>
    <!-- End custom js for this page-->
  </body>
</html>