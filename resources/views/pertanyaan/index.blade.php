@extends('adminlte.master')

@section('content')
    <div class="container">
        @foreach ($datas as $data)
            <div class="row bg-primary p-2 m-2">
                <div class="col-md">
                    <h3><a href="/pertanyaan/{{$data->id}}/{{$data->judul}}" class="bg-secondary">{{$data->judul}}</a></h3>
                    <p>tag tag tag tag</p>
                    <p>dibuat oleh <span>ardipermana59@gmail.com</span></p>
                </div>
            </div>
        @endforeach
        
    </div>
    
@endsection
