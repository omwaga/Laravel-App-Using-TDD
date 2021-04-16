<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<h1>BirdBoard</h1>
	<h4>Create a project</h4>
	<div class="container">
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
			<div class="form-control">
				<button type="Submit" class="btn btn-primary">Submit</button>
			</div>
		</form>
	</div>
</body>
</html>
