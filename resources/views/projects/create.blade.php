@extends('layouts.app')
@section('content')
<div class="col-md-12">
	<div style="display: flex; align-items: center;" class="m-2">
		<p style="margin-right: auto;" class="text-secondary">
			<a href="/projects">My Projects</a> / New Project
		</p>
	</div>

	<main>
		<h4 style="margin-right: auto;" class="text-secondary">Add a Project</h4>

		<form method="POST" action="/projects">

			@include('projects._form', [
			'project' => new App\Project,
			'buttonText' => 'Create a Project'
			])

		</form>
	</main>

</div>
@endsection
