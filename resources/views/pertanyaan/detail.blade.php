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
					<a href="">tag</a>
					<a href="">tag</a>
				</div>
				<div>
					<p>
						@if (Auth::id() == $question->user_id)
							<form action="/pertanyaan/{{$question->id}}" method="post" class="d-inline">
								@csrf
								@method('delete')
								<button type="submit" class="badge badge-secondary">Delete</button>
							</form>
						@endif 
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
						<textarea class="form-control" placeholder="Jawaban Kamu ..." class="p-3" name="content"></textarea>
					</div>
					<button type="submit" class="btn btn-primary">Kirim Jawaban</button>
				</form>
				</div>
		</div>
	</div>
@endsection
