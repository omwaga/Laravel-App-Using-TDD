@extends('layouts.app')
@section('content')
<div class="col-md-12">
	<div style="display: flex; align-items: center;" class="m-2">
		<p style="margin-right: auto;" class="text-secondary">
			<a href="/projects">My Projects</a> / {{$project->title}}
		</p>
		<a href="{{$project->path().'/edit'}}" class="btn btn-danger">Edit Project</a>
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
					<div>
						<form method="POST" action="{{$task->path()}}">
							@method('PATCH')
							@csrf

							<div style="display: flex; align-items: center;">
								<input type="text" class="form-control {{$task->completed ? 'text-secondary' : ''}}" name="body" value="{{ $task->body }}">
								<input class="form-control" type="checkbox" name="completed" onChange="this.form.submit()" {{$task->completed ? 'checked' : ''}}>
							</div>
						</form>
					</div>
				</div>
				@endforeach
				<div class="card p-3 mb-3">
					<div>
						<form method="POST" action="{{$project->path().'/tasks'}}">
							@csrf

							<input type="text" class="form-control" name="body" placeholder="Add a new task ...">
						</form>
					</div>
				</div>

				<h4 style="margin-right: auto;" class="text-secondary mt-5">General Notes</h4>
				<div class="card p-3">
					<div>
						<form method="POST" action="{{$project->path()}}">
							@csrf
							@method('PATCH')

							<textarea class="form-control" name="notes" placeholder="Anything you want to make a note of ...">{{$project->notes}}</textarea>

							<button type="submit" class="btn btn-danger mt-2">Save</button>
						</form>

						@if($errors->any())
						<div class="mt-3">
							@foreach($errors->all() as $error)
							<li class="text-sm text-danger">{{$error}}</li>
							@endforeach
						</div>
						@endif

					</div>
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
