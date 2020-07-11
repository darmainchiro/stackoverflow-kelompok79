@extends('adminlte.master')
@section('title-page','Daftar Pertanyaan')
@section('content')
<div class="container">
    @foreach( $questions as $key => $question)
    <div class="row p-2">
        <div class="col-md-2 d-flex justify-content-center text-center mt-auto mb-auto">
            <div class="mr-2">
                <span class="d-block">
                        @php
                            $nilai = 0;
                                foreach($reputasis as $reputasi){
                                    if($reputasi->question_id == $question->id)
                                    {
                                        $nilai++;
                                    }
                                }
                                echo $nilai;
                            @endphp
                </span>
                <span>vote</span>
            </div>
            <div class="ml-2">
                <span class="d-block">
                    @php
                    $nilai = 0;
                        foreach($answers as $answer){
                            if($answer->question_id == $question->id)
                            {
                                $nilai++;
                            }
                        }
                        echo $nilai;
                    @endphp
                </span>
                <span>jawaban</span>
            </div>

        </div>
        <div class="col-md-10 bg-secodndary">
            <div class="judul">
                <a href="/questions/{{$question->id}}">
                    <h4>{{$question->title}}</h4>
                </a>
            </div>
            <div>
                <div class="tags float-left">
                    @php
                        $tags = explode(',',$question->tags);

                        foreach($tags as $tag){
                            echo "<a href='' class='badge badge-primary mr-2'>$tag</a>&nbsp";
                            }


                    @endphp
                    
                </div>
                <div class="float-right"><small>{{date('l H:i A',$question->waktu_buat)}}</small></div>
            </div>
        </div>
    </div>
    @endforeach
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title mt-2">Daftar Pertanyaan</h3>
                </div>

                <div class="card-body">
                    {{-- Kita full main data tables, ada dibagian script --}}
                    <table id="questions-table" class="table table-bordered table-hover"></table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Ini buat jalanin fungsi hapus. Formnya aku hidden sehingga yang kepake button icon 'trash' yang ada di file '/pertanyaan/action.blade.php' --}}
<form method="POST" id="delete-form">
    @csrf
    @method('delete')

    <input type="submit" value="hapus" style="display:none">
</form>
@endsection

@push('scripts')
<!-- @include('adminlte.partials.alert') -->
<script>
    $(function () {
        $('#questions-table').DataTable({
            processing: true,
            serverSide: true,
            info: false,
            ajax: '{{ route('questions.data') }}', // Ini diambil dari route '/questions/data' atau di DataController@questions
            dom: '<"btn-tambah">frtlp',
            columns: [{
                    title: 'Id',
                    data: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    title: 'Vote', // Ini judul kolom sehingga kita nda perlu lagi buat <th>Vote</th>
                    data: 'vote', // ini merupakan variabel dari backend (intinya namanya harus sesuai yg dikirim dari backend)
                    className: 'text-center',
                },
                {
                    title: 'Total Jawaban',
                    data: 'answers',
                    className: 'text-center',
                    // Key 'render' intinya berfungsi untuk untuk manipulasi data sebelum ditampilkan di list tabel
                    // penjelasannya: aku get data 'answer'(inikan dalam bentuk array) terus aku count panjang arraynya maka yg ditampilkan bukan value dari 'answers'
                    render: function (data, type, row) {
                        // parameter data: merupakan representasi dari "data: 'answers'" sehingga jika di console log si 'data' maka akan menampilkan value dari 'answers'
                        // type: ini aku lupa fungsinya apa tapi jarang aku pake
                        // row: merupakan representasi dari seluruh request yg dikirim dari backend.
                        // Contoh jika kita console log "row['vote']" maka yang muncul value dari 'vote'
                        return data.length
                    }
                },
                {
                    title: 'Judul',
                    name: 'title',
                    data: 'title'
                },
                {
                    title: 'Tags',
                    data: 'tags',
                    className: 'text-center',
                    render: function (data, type, row) {
                        let arraySplit = data.split(
                        ','); // Kan awalnya "laravel, lumen, liveware" lalu aku split tanda koma maka akan jadi ["laravel", "lumen", "liveware"]
                        result = '';

                        // Lalu hasil arraynya aku looping trus aku gabung dalam satu string html
                        arraySplit.forEach((data) => {
                            result +=
                                `<span class="badge badge-info">${data}</span>&nbsp;`
                        });

                        return result;
                    },
                },
                {
                    title: 'Dibuat oleh',
                    className: 'text-center',
                    data: 'user.name'
                },
                {
                    title: 'Aksi',
                    data: 'action',
                    className: 'text-center',
                }
            ],
        })

        $('div.btn-tambah').html('<a href="{{ route('questions.create') }}" class="btn btn-primary mb-n5">Buat pertanyaan</a>')
    })
</script>
@endpush
