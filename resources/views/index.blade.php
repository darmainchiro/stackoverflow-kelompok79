@extends('adminlte.master')
@section('title-page','Daftar Pertanyaan')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title mt-2">Daftar Pertanyaan</h3>
                </div>

                <div class="card-body">
                    <table id="questions-table" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Vote</th>
                                <th>Jawaban</th>
                                <th>Judul</th>
                                <th>Dibuat oleh</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
@include('adminlte.partials.alert')
<script>
    $(function () {
            $('#questions-table').DataTable({
                processing: true,
                serverSide: true,
                info: false,
                ajax: '{{ route('questions.data') }}',
                dom: '<"btn-tambah">frtlp',
                columns: [
                    { data: 'DT_RowIndex', orderable: false, searchable: false},
                    { data: 'vote'},
                    {
                        data: 'answers',
                        render: function (data, type, row) {
                            return data.length
                        }
                    },
                    { data: 'title'},
                    { data: 'user.name'},
                    { data: 'action', align: 'center'}
                ],
            })

            $('div.btn-tambah').html('<a href="{{ route('questions.create') }}" class="btn btn-primary mb-n5">Buat pertanyaan</a>')
        })
</script>
@endpush
