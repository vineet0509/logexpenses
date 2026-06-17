<?php
namespace App\Http\Controllers;
use App\Models\LabourBill;
use Illuminate\Http\Request;

class LabourBillController extends Controller
{
    public function index(Request $request)
    {
        $projectId = $request->query('project_id');
        $query = LabourBill::with('labourContractor');
        if ($projectId) {
            $query->where('project_id', $projectId);
        }
        return response()->json($query->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'labour_contractor_id' => 'required|exists:labour_contractors,id',
            'amount' => 'required|numeric',
            'work_description' => 'nullable|string',
            'bill_date' => 'nullable|date'
        ]);
        $validated['status'] = 'Pending';
        $bill = LabourBill::create($validated);
        return response()->json($bill->load('labourContractor'), 201);
    }

    public function show(LabourBill $labourBill)
    {
        return response()->json($labourBill->load(['labourContractor', 'labourPayments']));
    }

    public function update(Request $request, LabourBill $labourBill)
    {
        $labourBill->update($request->all());
        return response()->json($labourBill);
    }

    public function destroy(LabourBill $labourBill)
    {
        $labourBill->delete();
        return response()->json(null, 204);
    }
}