<?php
namespace App\Http\Controllers;
use App\Models\Bill;
use Illuminate\Http\Request;

class BillController extends Controller
{
    public function index(Request $request)
    {
        $projectId = $request->query('project_id');
        $query = Bill::with(['vendor', 'category']);
        if ($projectId) {
            $query->where('project_id', $projectId);
        }
        return response()->json($query->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'vendor_id' => 'required|exists:vendors,id',
            'category_id' => 'nullable|exists:categories,id',
            'bill_amount' => 'required|numeric',
            'bill_date' => 'nullable|date',
            'description' => 'nullable|string',
            'attachment_url' => 'nullable|string'
        ]);
        $validated['status'] = 'Pending';
        $bill = Bill::create($validated);
        return response()->json($bill->load(['vendor', 'category']), 201);
    }

    public function show(Bill $bill)
    {
        return response()->json($bill->load(['vendor', 'category', 'payments']));
    }

    public function update(Request $request, Bill $bill)
    {
        $bill->update($request->all());
        return response()->json($bill);
    }

    public function destroy(Bill $bill)
    {
        $bill->delete();
        return response()->json(null, 204);
    }
}