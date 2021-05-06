@csrf

<div class="form-group">
	<label>Title:</label>
	<input type="text" class="form-control" name="title" value="{{$project->title}}" required="">
</div>

<div class="form-group">
	<label>Description:</label>
	<textarea name="description" class="form-control" required="">{{$project->description}}</textarea>
</div>

<div>
	<button type="Submit" class="btn btn-primary">{{$buttonText}}</button>
	<a href="{{$project->path()}}">Cancel</a>
</div>

@if($errors->any())
<div class="mt-3">
	@foreach($errors->all() as $error)
	<li class="text-sm text-danger">{{$error}}</li>
	@endforeach
</div>
@endif
