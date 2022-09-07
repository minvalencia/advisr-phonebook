<!DOCTYPE html>
<html lang="en">
@include('layouts.partials.header')

<body>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        <div class="container-fluid page-body-wrapper  full-page-wrapper">
            @yield('content')
        </div>
    </div>
    <script src="{{ url('assets/js/jquery.min.js') }}"></script>
    <!-- plugins:js -->
    <script src="{{ url('assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ url('assets/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ url('assets/vendors/progressbar.js/progressbar.min.js') }}"></script>
    <script src="{{ url('assets/vendors/jvectormap/jquery-jvectormap.min.js') }}"></script>
    <script src="{{ url('assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ url('assets/vendors/owl-carousel-2/owl.carousel.min.js') }}"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ url('assets/js/off-canvas.js') }}"></script>
    <script src="{{ url('assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ url('assets/js/misc.js') }}"></script>
    <script src="{{ url('assets/js/settings.js') }}"></script>
    <script src="{{ url('assets/js/todolist.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="{{ url('assets/js/dashboard.js') }}"></script>
    <!-- End custom js for this page -->

    @stack('scripts')
</body>

</html>
