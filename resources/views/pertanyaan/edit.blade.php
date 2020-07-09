@extends('adminlte.master')
@section('title-page','Edit Pertanyaan')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Form ubah pertanyaan</h1>

            <form action="{{ route('questions.update', $question->id) }}" method="post">
                @csrf
                @method('put')

                <div class="form-group">
                    <label for="title">Judul Pertanyaan</label>
                    <input type="text" name="title" id="title" placeholder="masukan title" class="form-control p-2"
                        value="{{$question->title}}">
                </div>
                <div class="form-group">
                    <label for="content">Isi Jawaban</label>
                    <textarea placeholder="masukan content" rows="8" class="form-control"
                        name="content">{{$question->content}}</textarea>
                </div>

                <div class="form-group">
                    <label for="tag">Tag</label>
                    <input type="text" name="tags" placeholder="Tulis tag disini" class="form-control p-2"
                        value="{{ $question->tags }}">
                    <small class="form-text text-muted">Gunakan tanda "," sebagai pemisah tag. <b>Contoh: laravel,
                            lumen,
                            liveware</b></small>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection
