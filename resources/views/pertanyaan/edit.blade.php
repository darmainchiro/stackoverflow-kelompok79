@extends('adminlte.master')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1>Form buat pertanyaan</h1>

				<form action="/pertanyaan/{{$question->id}}/update" method="post">
					@csrf
					@method('put')
					<div class="form-group">
						<label for="judul">Judul</label>
						<input type="text" name="judul" id="judul" placeholder="masukan judul" class="form-control p-2" value="{{$question->judul}}">
					</div>
					<div class="form-group">
						<label for="isi">isi</label>
						<textarea placeholder="masukan isi" rows="8" class="form-control" name="isi">{{$question->isi}}</textarea>
					</div>
					<button type="submit" class="btn btn-primary">Buat Pertanyaan</button>
				</form>
			</div>
		</div>
	</div>
@endsection
