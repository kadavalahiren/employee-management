<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>{{ 'AdminLTE Dashboard' }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="serverurl" content="{{ env('APP_URL') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8">

    <script src="{{ asset('admin/newTheme/assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('admin/newTheme/assets/js/config.js') }}"></script>
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="assets/img/Bitmap.png" />

    <!-- Fonts -->
     <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;display=swap"
        rel="stylesheet">

        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('admin/newTheme/assets/vendor/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/newTheme/assets/vendor/fonts/tabler-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/newTheme/assets/vendor/fonts/flag-icons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('admin/newTheme/assets/vendor/css/rtl/core.css') }}"
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('admin/newTheme/assets/vendor/css/rtl/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('admin/newTheme/assets/css/product-category.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet"
        href="{{ asset('admin/newTheme/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/newTheme/assets/vendor/libs/node-waves/node-waves.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/newTheme/assets/vendor/libs/typeahead-js/typeahead.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('admin/newTheme/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />

    <link rel="stylesheet" href="{{ asset('admin/newTheme/assets/vendor/libs/flatpickr/flatpickr.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/newTheme/assets/css/style.css') }}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Heebo:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    @yield('links')
</head>
<body>
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5DDHKGP" height="0" width="0"
            style="display: none; visibility: hidden"></iframe></noscript>

    <div class="layout-wrapper layout-content-navbar  ">
        <div class="layout-container">
            <!-- Menu -->
            @include('layouts.new.sidebar')
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Content wrapper -->
                <div class="content-wrapper">

                    <!-- Content -->
                    <!-- Your Page Content Here -->
                    @yield('content')
                    <!-- / Content -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
        <!-- Drag Target Area To SlideIn Menu On Small Screens -->
        <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('admin/newTheme/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('admin/newTheme/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('admin/newTheme/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('admin/newTheme/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('admin/newTheme/assets/vendor/libs/node-waves/node-waves.js') }}"></script>

    <script src="{{ asset('admin/newTheme/assets/vendor/libs/hammer/hammer.js') }}"></script>
    <script src="{{ asset('admin/newTheme/assets/vendor/libs/i18n/i18n.js') }}"></script>
    <script src="{{ asset('admin/newTheme/assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>

    <script src="{{ asset('admin/newTheme/assets/vendor/js/menu.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <!-- Flat Picker -->
    <script src="{{ asset('admin/newTheme/assets/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('admin/newTheme/assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('admin/newTheme/assets/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>


    {{-- <script src="asset('admin/newTheme/assets/js/tables-datatables-advanced.js')"></script> --}}
    @yield('scripts')
    @yield('page-scripts')
</body>

</html>
