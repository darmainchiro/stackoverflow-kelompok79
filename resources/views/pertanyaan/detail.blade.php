@extends('adminlte.master')

@section('content')
	<div class="container">
		<div class="row p-3">
			<div class="col-md-12">
				<h1>{{$question->judul}}</h1>
			</div>

		</div>
		<div class="row p-3">
			<div class="col-md-12">
				<p>
					{!! $question->isi !!}
				</p>
				<div class="tags">
					<a href="">tag</a>
					<a href="">tag</a>
				</div>
				<div>
					<p>
						<form action="/pertanyaan/{{$question->id}}" method="post" class="d-inline">
							@csrf
							@method('delete')
							<button type="submit" class="badge badge-secondary">Delete</button>
						</form>
						<a href="/pertanyaan/{{$question->id}}" class="badge badge-secondary">edit</a>
					</p>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<form action="" method="post">
					@csrf
					<div class="form-group">
						<label>Jawaban Kamu</label>
						<textarea class="form-control" placeholder="Jawaban Kamu ..." class="p-3" name="isi"></textarea>
					</div>
					<button type="submit" class="btn btn-primary">Kirim Jawaban</button>
				</form>
				</div>
		</div>
	</div>
@endsection