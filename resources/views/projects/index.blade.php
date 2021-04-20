@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
	<div class="col-md-12">
		<div style="display: flex; align-items: center;" class="m-2">
			<h4 style="margin-right: auto;" class="text-secondary">My Projects</h4>
			<a href="/projects/create" class="btn btn-danger">New Project</a>
		</div>

		<div class="row">
			@forelse($projects as $project)
			<div class="card col-md-4 shadow rounded py-3 m-2">
				<h3 class="border-left border-lg border-danger">
					<a href="{{$project->path()}}" class="h4 text-dark" style="text-decoration: none;">{{$project->title}}</a>
				</h3>
				<div>{{ Str::limit($project->description, 100, $end = '...')}}</div>
			</div>
			@empty
			<div>No projects added.</div>
			@endforelse
		</div>

	</div>
</div>
@endsection
