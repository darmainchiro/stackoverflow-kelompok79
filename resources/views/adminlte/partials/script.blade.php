<!-- jQuery -->
<script src="{{ asset('/adminlte/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('/adminlte/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('/adminlte/dist/js/demo.js') }}"></script>

<!-- script tambahan sweet alert, bukan dari bawaan sb-admin-2 -->
<script src="{{ asset('/adminlte/dist/js/swal.min.js') }}"></script>

<!-- DataTables -->
<script src="{{ asset('/adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

@stack('scripts')