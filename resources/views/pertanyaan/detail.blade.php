@extends('adminlte.master')
@section('title-page','Detail Pertanyaan')


@section('content')
<div class="container">
    <div class="row p-3">
        <div class="col-md-12">
            <h1>{{$question->title}}</h1>
        </div>

    </div>
    <div class="row p-3">
        <div class="col-md-12">
            <p>
                {!! $question->content !!}
            </p>
            <div class="tags">
                @php
                $tags = explode(',', $question->tags);

                foreach ($tags as $tag) {
                echo "<span class='badge badge-info'>{$tag}</span>&nbsp;";
                }
                @endphp
            </div>

            <div class="my-2">
                List komen:
                <ul>
                    @foreach ($question->comments as $data)
                    <li>{{ $data->pivot->comment }}</li>
                    @endforeach
                </ul>
            </div>
            <div>
                <p>
                    @if (Auth::id() == $question->user_id)
                    <form action="{{ route('questions.destroy', $question->id) }}" method="post" class="d-inline">
                        @csrf
                        @method('delete')
                        <button type="submit" class="badge badge-secondary">Delete</button>
                    </form>
                    <a href="{{ route('questions.edit', $question->id) }}" class="badge badge-secondary">edit</a>
                    @endif

                </p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <form action="{{ route('questions.comment.store', $question->id) }}" method="post">
                @csrf
                <div class="form-group">
                    <label>Beri komen ke pertanyaan</label>
                    <textarea class="form-control" placeholder="Komen Kamu ..." class="p-3" name="comment"></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Tambahkan komen</button>
            </form>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col">
            <form action="/answers/store" method="post">
                @csrf
                <div class="form-group">
                    <label>Jawaban Kamu</label>
                    <textarea class="form-control" placeholder="Jawaban Kamu ..." class="p-3" name="comment"></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Kirim Jawaban</button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
@include('adminlte.partials.alert')
@endpush
