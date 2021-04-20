@extends('layouts.app')
@section('content')
<div class="col-md-12">
	<div style="display: flex; align-items: center;" class="m-2">
		<p style="margin-right: auto;" class="text-secondary">
			<a href="/projects">My Projects</a> / {{$project->title}}
		</p>
		<a href="/projects/create" class="btn btn-danger">Add Tasks</a>
	</div>

	<div class="row">
		<div class="col-md-8">
			<div class="card p-3">
				<div>{{$project->description}}</div>
			</div>

			<main class="mt-5">
				<h4 style="margin-right: auto;" class="text-secondary">Tasks</h4>

				@foreach($project->tasks as $task)
				<div class="card p-3 mb-3">
					<div>{{ $task->body }}</div>
				</div>
				@endforeach

				<h4 style="margin-right: auto;" class="text-secondary mt-5">General Notes</h4>
				<div class="card p-3">
					<div>{{$project->description}}</div>
				</div>
			</main>

			<a href="/projects"> Go Back</a>
		</div>

		<div class="col-md-4">
			<div class="card p-3">
				<h3 class="border-left border-lg border-danger">
					<a href="" class="h4 text-dark" style="text-decoration: none;">Title Here</a>
				</h3>
				<div>And description</div>
			</div>
		</div>
	</div>
</div>
@endsection
