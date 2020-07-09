@extends('adminlte.master')

@section('content')
<div class="card">
    <div class="card-header">
    <h3 class="card-title">Stackoverflow Indo</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
    Halo
    </div>
    @if(Auth::user() != '')
    oke
    @endif
    <!-- /.card-body -->
</div>
@endsection

@push('scripts')
<script src="{{ asset('/adminlte/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
<script>
  $(function () {
    $("#example1").DataTable();
  });
</script>
@endpush