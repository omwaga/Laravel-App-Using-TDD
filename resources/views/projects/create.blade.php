@extends('layouts.app')
@section('content')
<h1>BirdBoard</h1>
<h4>Create a project</h4>
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
@endsection
