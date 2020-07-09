@extends('adminlte.master')
@section('title-page','Daftar Pertanyaan')
@section('content')
<div class="container">
    @if ( count($datas) == 0)
    <div class="row p-2 m-2">
        <div class="col-md">
            <p class="text-center">Tidak ada data</p>
        </div>
    </div>
    @else
    @foreach ($datas as $data)
    <div class="row p-2 m-2">
        <div class="col-md-2 ">
            <div class="row">
                <div class="col text-center">

                    <span>{{$data->vote}}</span>
                    <span class="d-block">Votes</span>

                </div>
                <div class="col text-center">
                    <span>{{$data->vote}}</span>
                    <span class="d-block">Jawaban</span>
                </div>
            </div>
        </div>
        <div class="col-md-10">
            <h3><a href="/pertanyaan/{{$data->id}}/{{$data->title}}" class="">{{$data->title}}</a></h3>
            {{-- <p class="d-inline">{{$data->tag}}</p> --}}
            <p class="float-right">dibuat oleh <span>{{$data->email}}</span></p>
        </div>
    </div>
    @endforeach
    @endif

</div>

@endsection

@push('scripts') @include('adminlte.partials.alert') @endpush
