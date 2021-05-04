@extends('layouts.app')
@section('content')
<div class="col-md-12">
	<div style="display: flex; align-items: center;" class="m-2">
		<p style="margin-right: auto;" class="text-secondary">
			<a href="/projects">My Projects</a> / {{$project->title}}
		</p>
	</div>

	<main>
		<h4 style="margin-right: auto;" class="text-secondary">Edit Your Project</h4>

		<form method="POST" action="{{$project->path()}}">
			@method('PATCH')

			@include('projects._form', ['buttonText' => 'Update Project'])

		</form>
	</main>

</div>
@endsection
