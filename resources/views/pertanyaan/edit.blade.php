@extends('adminlte.master')
@section('title-page','Edit Pertanyaan')

@push('script-head')
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
@endpush @section('content')

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
                    <input type="text" name="title" id="title" placeholder="masukan title" class="form-control p-2 @error('title') is-invalid @enderror" value="{{$question->title}}">
                    @error('title') <div class="invalid-feedback">{{$message}}</div>  @enderror
                </div>
                <div class="form-group">
                    <label for="content">Isi Jawaban</label>
                    <textarea name="content" class="form-control my-editor p-2 @error('content') is-invalid @enderror">{{$question->content}}</textarea>
                    @error('content') <div class="invalid-feedback">{{$message}}</div>  @enderror
                </div>

                <div class="form-group">
                    <label for="tag">Tag</label>
                    <input type="text" name="tags" placeholder="Tulis tag disini" class="form-control p-2 @error('tags') is-invalid @enderror" value="{{ $question->tags }}">
                    <small class="form-text text-muted">Gunakan tanda "," sebagai pemisah tag. <b>Contoh: laravel,lumen,liveware</b></small>
                    @error('tags') <div class="invalid-feedback">{{$message}}</div>  @enderror
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection

@endsection @push('scripts')
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
@endpush

