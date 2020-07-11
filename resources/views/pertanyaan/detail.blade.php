@extends('adminlte.master')
@section('title-page','Detail Pertanyaan')
@push('script-head')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
@endpush

@section('content')
<div class="container">
    <div class="row p-3">

        <div class="col-md-12">
            <h1>{{$questions->title}}</h1>
        </div>

    </div>
    <div class="row p-3">
        <div class="col-md-1 text-center mt-auto mb-auto" >
                <a href="/questions/upvote/{{$questions->id}}"><i class="fas fa-caret-up" style="font-size: 3.5em;"></i></a>
                <span class="d-block" style="font-size: 1.5em; margin-top: -10px; margin-bottom: -10px">
                @php
                    $voteQuestion = 0;
                    foreach($reputasis as $reputasi){
                        if($questions->id == $reputasi->question_id && $reputasi->answer_id == 0){
                            $voteQuestion += $reputasi->vote;
                            }
                      };
                      echo $voteQuestion;
                @endphp
                </span>
                <a href="/questions/downvote/{{$questions->id}}"><i class="fas fa-caret-down" style="font-size: 3.5em;"></i></a>
            </div>
        <div class="col-md-11 border-left pl-4">
            <h4 class="float-left">{{$questions->name}}</h4>
            <span class="float-right">{{date('l H:i A',$questions->waktu_buat)}}</span>
            <p style="clear: both;">
                {!! $questions->content !!}
            </p>
            <div class="tags">
                @php
                    $tags = explode(',', $questions->tags);

                    foreach ($tags as $tag) {
                         echo "<a href='{$tag}' class='badge badge-info p-1'>{$tag}</a>&nbsp;";
                    }
                @endphp
            </div>
            <div>
                <p>
                    @if (Auth::id() == $questions->user_id)
                    <form action="{{ route('questions.destroy', $questions->id) }}" method="post" class="d-inline">
                        @csrf
                        @method('delete')
                        <button type="submit" class="badge badge-danger border-none border p-2">Hapus</button>
                    </form>
                    <a href="{{ route('questions.edit', $questions->id) }}" class="badge badge-warning p-2">EDIT</a>
                    @endif

                </p>
            </div>
        </div>
    </div>
    <div class="pl-4 mt-2 mb-1 ">
            <h5><span>{{count($answers)}} </span>Jawaban</h5>
    </div>
    @foreach ($answers as $answer)
   <section class="jawaban">
        <div class="row mt-4 pl-2">
            <div class="col-md-1 text-center offset-md-1" >
                <a href="/answers/upvote/{{$answer->id}}/{{$questions->id}}"><i class="fas fa-caret-up" style="font-size: 2.5em;"></i></a>
                <span class="d-block" style="font-size: 1.5em; margin-top: -10px; margin-bottom: -10px">
                    @php
                    $voteAnswer = 0;
                    foreach($reputasis as $reputasi){
                        if($questions->id == $reputasi->question_id && $reputasi->answer_id == $answer->id){
                            $voteAnswer += $reputasi->vote;
                            }
                      };
                      echo $voteAnswer;
                @endphp
                </span>
                <a href="/answers/downvote/{{$answer->id}}/{{$questions->id}}"><i class="fas fa-caret-down" style="font-size: 2.5em;"></i></a>
            </div>
            <div class="col-md-10 p-2 border-left">
                <div class="float-left">
                        <h5>{{$answer->name}}</h5>
                </div>
                <div class="float-right">
                    <span><small>{{ date('l H:i A',$answer->waktu_buat) }}</small></span>                    
                    @if($answer->best_answer > 0)
                        <span class="float-"><i class="fa fa-star-o text-warning" style="font-size:36px"></i></span>
                    @endif
                </div>
                <div class="mb-5" style="clear: both;">
                    <p class="">{!! $answer->content !!}</p> 
                </div>
                <div class="justify-content-end pr-3" style="clear: both;">
                    <div class="float-left">
                        <span class="klikJawaban">komentar</span>
                           @if ($questions->user_id == Auth::id() && $answer->best_answer == 0)
                                    <a class="badge-" href="/answer/best-answer/{{$answer->id}}/{{$questions->id}}"> Vote jawaban terbaik</a>
                            @elseif ($questions->user_id == Auth::id() && $answer->best_answer == 1)
                                    <a class="badge-" href="/answer/best-answer/{{$answer->id}}/{{$questions->id}}"> Batalkan Vote</a>
                           @endif
                    </div>                   
                </div>
            </div>
        </div>  
        @foreach ($comments as $comment)
            @if ($comment->answer_id == $answer->id)
                <div class="row mt-1">
                    <div class="col-md-9 offset-md-3 p-3">
                        <div>
                            <h6 class="float-left">Ardi</h6>
                            <span class="float-right"><small>{{ date('l H:i A',$comment->waktu_buat) }}</small></span>
                        </div>
                        <div style="clear: both;">
                            {{$comment->comment}}
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
        <div class="row">
            <div class="col-md-8 offset-md-4 commentForm" style="display: none;">
                <form action="/answers/comment" method="post">
                    @csrf
                    <input type="hidden" name="question_id" value="{{$questions->id}}">
                    <input type="hidden" name="answer_id" value="{{$answer->id}}">
                    <div class="form-group">
                        <input type="text" class="form-control" name="comment">
                    </div>
                    <button type="submit" class="btn btn-primary float-right">Komen</button>
                </form>
            </div>
        </div>  
   </section>
    @endforeach 
    <div class="row mt-4">
        <div class="col-md p-5">
            <form action="/answers/{{$questions->id}}/store" method="post">
                @csrf

                <div class="form-group">
                    <label>Jawaban Kamu</label>
                    <textarea name="content" class="form-control my-editor p-2"></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Kirim Jawaban</button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
@include('adminlte.partials.alert')
<script>
    var editor_config = {
        path_absolute: "/",
        selector: "textarea.my-editor",
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
        relative_urls: false,
        file_browser_callback: function(field_name, url, type, win) {
            var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName(
                'body')[0].clientWidth;
            var y = window.innerHeight || document.documentElement.clientHeight || document
                .getElementsByTagName('body')[0].clientHeight;

            var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
            if (type == 'image') {
                cmsURL = cmsURL + "&type=Images";
            } else {
                cmsURL = cmsURL + "&type=Files";
            }

            tinyMCE.activeEditor.windowManager.open({
                file: cmsURL,
                title: 'Filemanager',
                width: x * 0.8,
                height: y * 0.8,
                resizable: "yes",
                close_previous: "no"
            });
        }
    };

    tinymce.init(editor_config);
</script>
<script type="text/javascript">
    $(document).on('click','.klikJawaban', function(){
        $('.commentForm').hide();
        find('.commentForm').css('display','block');
    });
    // $().click()
</script>
@endpush