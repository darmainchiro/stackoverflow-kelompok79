@extends('adminlte.master')
@section('title-page','Detail Pertanyaan')
@push('script-head')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endpush

@section('content')
<div class="container">
    <div class="row p-3">
        <div class="col-md-12">
            <h1>{{$question->title}}</h1>
        </div>

    </div>
    <div class="row p-3">
        <div class="col-md-1 text-center mt-auto mb-auto" >
                <a href="/questions/upvote/{{$question->id}}"><i class="fas fa-caret-up" style="font-size: 3.5em;"></i></a>
                <span class="d-block" style="font-size: 1.5em; margin-top: -10px; margin-bottom: -10px">
                @php
                    $voteQuestion = 0;
                    foreach($reputasis as $reputasi){
                        if($question->id == $reputasi->question_id && $reputasi->answer_id == 0){
                            $voteQuestion += $reputasi->vote;
                            }
                      };
                      echo $voteQuestion;
                @endphp
                </span>
                <a href="/questions/downvote/{{$question->id}}"><i class="fas fa-caret-down" style="font-size: 3.5em;"></i></a>
            </div>
        <div class="col-md-11 border-left pl-4">
            <p>
                {!! $question->content !!}
            </p>
            <div class="tags">
                @php
                    $tags = explode(',', $question->tags);

                    foreach ($tags as $tag) {
                         echo "<a href='{$tag}' class='badge badge-info'>{$tag}</a>&nbsp;";
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
   <section class="answers">
        @foreach ($answers as $answer)
        <div class="row mt-4">
            <div class="col-md-1 text-center" >
                <a href="/answers/upvote/{{$answer->id}}/{{$question->id}}"><i class="fas fa-caret-up" style="font-size: 2.5em;"></i></a>
                <span class="d-block" style="font-size: 1.5em; margin-top: -10px; margin-bottom: -10px">
                    @php
                    $voteAnswer = 0;
                    foreach($reputasis as $reputasi){
                        if($question->id == $reputasi->question_id && $reputasi->answer_id == $answer->id){
                            $voteAnswer += $reputasi->vote;
                            }
                      };
                      echo $voteAnswer;
                @endphp
                </span>
                <a href="/answers/downvote/{{$answer->id}}/{{$question->id}}"><i class="fas fa-caret-down" style="font-size: 2.5em;"></i></a>
            </div>
            <div class="col-md-11 p-2 badge-secondary">
                <div class="mb-5">
                    <p class="float-left">{{$answer->content}}</p> 
                    @if($answer->best_answer > 0)
                        <span class="float-right"><i class="fa fa-star-o text-warning" style="font-size:36px"></i></span>
                    @endif
                </div>
                <div class="justify-content-end pr-3" style="clear: both;">
                   <div class="float-left komentar">
                       komentar
                       @if ($answer->user_id == Auth::id())
                                <a class="badge-" href=""> best jawaban</a>
                       @endif

                   </div>
                   <div class="float-right">
                        dijawab oleh <span>{{$answer->name}}</span>
                   </div>
                </div>
            </div>
        </div>  
        @foreach ($comments as $comment)
            @if ($comment->answer_id == $answer->id)
                <div class="row mt-2">
                    <div class="col-md-10 offset-md-2 bg-primary p-3">
                        <div >
                            {{$comment->comment}}
                        </div>
                        <div class="float-right">
                            komentar dari
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
        <div class="row">
            <div class="col-md-8 offset-md-4">
                <form action="/answers/comment" method="post">
                    @csrf
                    <input type="hidden" name="question_id" value="{{$question->id}}">
                    <input type="hidden" name="answer_id" value="{{$answer->id}}">
                    <div class="form-group">
                        <input type="text" class="form-control" name="comment">
                    </div>
                    <button type="submit" class="btn btn-primary float-right">Komen</button>
                </form>
            </div>
        </div>  
    @endforeach  
   </section>
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
            <form action="/answers/{{$question->id}}/store" method="post">
                @csrf

                <div class="form-group">
                    <label>Jawaban Kamu</label>
                    <textarea class="form-control" placeholder="Jawaban Kamu ..." class="p-3" name="content"></textarea>
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
