<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateProjectRequest;
use App\Project;

class ProjectsController extends Controller
{
	public function index()
	{
		$projects = auth()->user()->projects;

		return view('projects.index', compact('projects'));
	}

	public function show(Project $project)
	{
		// if(auth()->id() !== $project->owner_id)
		// {
		// 	abort(403);
		// }

		if(auth()->user()->isNot($project->owner))
		{
			abort(403);
		}

		return view('projects.show', compact('project'));
	}

	public function create()
	{
		return view('projects.create');
	}

	public function store()
	{
		// $attributes['owner_id'] = auth()->id();

		$project = auth()->user()->projects()->create($this->ValidatedRequests());

		return redirect($project->path());
	}

	public function edit(Project $project)
	{
		return view('projects.edit', compact('project'));
	}

	public function update(UpdateProjectRequest $request, Project $project)
	{
		$project->update($request->validated());

		return redirect($project->path());
	}

   /**
	* Validate the request attributes
	*
	* @return array
	*/

	protected function ValidatedRequests()
	{
		return request()->validate([
			'title' => 'sometimes|required',
			'description' => 'required',
			'notes' => 'max:300'
		]);
	}
}
