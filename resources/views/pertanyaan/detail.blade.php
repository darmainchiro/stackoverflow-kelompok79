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
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
				</p>
				<div class="tags">
					<a href="">tag</a>
					<a href="">tag</a>
				</div>
			</div>
		</div>
		<div class="row">
			<form>
				<div class="form-group">
					<textarea class="form-control" placeholder="Jawaban Kamu ..." class="p-3" name="isi"></textarea>
				</div>
			</form>
		</div>
	</div>
@endsection
