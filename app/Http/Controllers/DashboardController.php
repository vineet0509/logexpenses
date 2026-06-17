<?php
namespace App\Http\Controllers;
use App\Models\Project;
use App\Models\Bill;
use App\Models\Payment;
use App\Models\LabourBill;
use App\Models\LabourPayment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $projectId = $request->query('project_id');
        if (!$projectId) {
            return response()->json(['error' => 'project_id is required'], 400);
        }

        $project = Project::findOrFail($projectId);
        
        $totalBudget = $project->budget ?? 0;
        $totalMaterialExpenses = Bill::where('project_id', $projectId)->sum('bill_amount');
        $totalLabourExpenses = LabourBill::where('project_id', $projectId)->sum('amount');
        
        $totalSpent = $totalMaterialExpenses + $totalLabourExpenses;
        $remainingBudget = $totalBudget - $totalSpent;
        
        $materialPaid = Payment::whereHas('bill', function($q) use ($projectId) {
            $q->where('project_id', $projectId);
        })->sum('amount');
        
        $labourPaid = LabourPayment::whereHas('labourBill', function($q) use ($projectId) {
            $q->where('project_id', $projectId);
        })->sum('amount');
        
        $totalOutstanding = $totalSpent - ($materialPaid + $labourPaid);

        return response()->json([
            'project' => $project->name,
            'budget' => (float)$totalBudget,
            'spent' => (float)$totalSpent,
            'remaining' => (float)$remainingBudget,
            'outstanding' => (float)$totalOutstanding,
            'expenses_breakdown' => [
                'materials' => (float)$totalMaterialExpenses,
                'labour' => (float)$totalLabourExpenses
            ]
        ]);
    }
}