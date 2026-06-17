<?php
namespace App\Http\Controllers;
use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function index(Request $request)
    {
        $projectId = $request->query('project_id');
        $query = Vendor::query();
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
            'address' => 'nullable|string',
            'notes' => 'nullable|string'
        ]);
        $vendor = Vendor::create($validated);
        return response()->json($vendor, 201);
    }

    public function show(Vendor $vendor)
    {
        return response()->json($vendor);
    }

    public function update(Request $request, Vendor $vendor)
    {
        $vendor->update($request->all());
        return response()->json($vendor);
    }

    public function destroy(Vendor $vendor)
    {
        $vendor->delete();
        return response()->json(null, 204);
    }
}