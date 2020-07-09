@extends('adminlte.master')
@section('title-page','Daftar Pertanyaan')
@section('content')
    <div class="container">
        @if ( count($datas) == 0)
            <div class="row bg-primary p-2 m-2">
                <div class="col-md">
                    <p class="text-center">Tidak ada data</p>
                </div>
            </div>
        @else
        @foreach ($datas as $data)
            <div class="row bg-primary p-2 m-2">
                <div class="col-md">
                    <h3><a href="/pertanyaan/{{$data->id}}/{{$data->title}}" class="bg-secondary">{{$data->title}}</a></h3>
                    <p>tag tag tag tag</p>
                    <p>dibuat oleh <span>ardipermana59@gmail.com</span></p>
                </div>
            </div>
        @endforeach
        @endif
        
    </div>
    
@endsection
