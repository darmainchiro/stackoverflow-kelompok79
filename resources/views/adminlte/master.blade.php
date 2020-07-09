<!DOCTYPE html>
<html>

@include('adminlte.partials.head')

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        @include('adminlte.partials.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('adminlte.partials.aside')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div>
        <!-- /.content-wrapper -->

        @include('adminlte.partials.footer')

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    @include('adminlte.partials.script')
</body>

</html>
