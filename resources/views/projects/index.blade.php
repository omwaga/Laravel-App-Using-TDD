@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
	<div class="col-md-8">
		<div style="display: flex; align-items: center;">
			<h1 style="margin-right: auto;">BirdBoard</h1>
			<a href="/projects/create">New Project</a>
		</div>

		<ul>
			@forelse($projects as $project)
			<li><a href="{{$project->path()}}">{{$project->title}}</a></li>
			@empty
			<li>No data yet</li>
			@endforelse
		</ul>
	</div>
</div>
@endsection
