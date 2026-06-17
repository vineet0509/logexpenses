<?php
namespace App\Http\Controllers;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(Project::where('user_id', $request->user()->id)->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'location' => 'nullable|string',
            'budget' => 'nullable|numeric',
            'start_date' => 'nullable|date',
            'expected_completion_date' => 'nullable|date',
            'notes' => 'nullable|string',
            'status' => 'nullable|string'
        ]);
        
        $project = $request->user()->projects()->create($validated);
        return response()->json($project, 201);
    }

    public function show(Project $project)
    {
        return response()->json($project);
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string',
            'location' => 'nullable|string',
            'budget' => 'nullable|numeric',
            'start_date' => 'nullable|date',
            'expected_completion_date' => 'nullable|date',
            'notes' => 'nullable|string',
            'status' => 'nullable|string'
        ]);
        $project->update($validated);
        return response()->json($project);
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return response()->json(null, 204);
    }
}