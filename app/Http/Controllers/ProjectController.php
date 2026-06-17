<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Resources\ProjectResource;
use Illuminate\Support\Facades\Gate;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $projects = $request->user()->projects()->paginate(15);
        return ProjectResource::collection($projects);
    }

    public function store(StoreProjectRequest $request)
    {
        $project = $request->user()->projects()->create($request->validated());
        return new ProjectResource($project);
    }

    public function show(Request $request, string $id)
    {
        $project = Project::findOrFail($id);
        Gate::authorize('view', $project);
        
        return new ProjectResource($project);
    }

    public function update(UpdateProjectRequest $request, string $id)
    {
        $project = Project::findOrFail($id);
        Gate::authorize('update', $project);
        
        $project->update($request->validated());
        return new ProjectResource($project);
    }

    public function destroy(Request $request, string $id)
    {
        $project = Project::findOrFail($id);
        Gate::authorize('delete', $project);
        
        $project->delete();
        return response()->json(null, 204);
    }
}
