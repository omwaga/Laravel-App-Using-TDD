@extends('layouts.app')
@section('content')
<div class="col-md-12">
	<div style="display: flex; align-items: center;" class="m-2">
		<p style="margin-right: auto;" class="text-secondary">
			<a href="/projects">My Projects</a> / New Project
		</p>
	</div>

	<main>
		<h4 style="margin-right: auto;" class="text-secondary">New Project</h4>

		<form method="POST" action="/projects">
			@csrf
			<div class="form-group">
				<label>Title:</label>
				<input type="text" class="form-control" name="title">
			</div>

			<div class="form-group">
				<label>Description:</label>
				<textarea name="description" class="form-control"></textarea>
			</div>

			<div>
				<button type="Submit" class="btn btn-primary">Submit</button>
				<a href="/projects">Cancel</a>
			</div>
		</form>
	</main>
</div>
@endsection
