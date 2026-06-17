<?php
namespace App\Http\Controllers;
use App\Models\LabourContractor;
use Illuminate\Http\Request;

class LabourContractorController extends Controller
{
    public function index(Request $request)
    {
        $projectId = $request->query('project_id');
        $query = LabourContractor::query();
        if ($projectId) {
            $query->where('project_id', $projectId);
        }
        return response()->json($query->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'name' => 'required|string',
            'mobile' => 'nullable|string',
            'work_type' => 'nullable|string'
        ]);
        $contractor = LabourContractor::create($validated);
        return response()->json($contractor, 201);
    }

    public function show(LabourContractor $labourContractor)
    {
        return response()->json($labourContractor);
    }

    public function update(Request $request, LabourContractor $labourContractor)
    {
        $labourContractor->update($request->all());
        return response()->json($labourContractor);
    }

    public function destroy(LabourContractor $labourContractor)
    {
        $labourContractor->delete();
        return response()->json(null, 204);
    }
}