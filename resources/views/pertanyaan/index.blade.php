@extends('adminlte.master')
@section('title-page','Home')
@section('content')
<div class="container">
    @foreach( $questions as $key => $question)
    <div class="row p-2 border-bottom">
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

@endsection

@push('scripts')
<!-- @include('adminlte.partials.alert') -->
@endpush
