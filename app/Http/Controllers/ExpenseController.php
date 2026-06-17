<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;
use App\Http\Resources\ExpenseResource;
use Illuminate\Support\Facades\Gate;

class ExpenseController extends Controller
{
    public function index(Request $request)
    {
        $expenses = Expense::whereHas('project', function ($query) use ($request) {
            $query->where('user_id', $request->user()->id);
        })->with('project')->paginate(15);
        
        return ExpenseResource::collection($expenses);
    }

    public function store(StoreExpenseRequest $request)
    {
        $project = \App\Models\Project::findOrFail($request->project_id);
        Gate::authorize('view', $project);

        $expense = Expense::create($request->validated());
        return new ExpenseResource($expense);
    }

    public function show(string $id)
    {
        $expense = Expense::with('project')->findOrFail($id);
        Gate::authorize('view', $expense);
        
        return new ExpenseResource($expense);
    }

    public function update(UpdateExpenseRequest $request, string $id)
    {
        $expense = Expense::findOrFail($id);
        Gate::authorize('update', $expense);

        if ($request->has('project_id')) {
            $project = \App\Models\Project::findOrFail($request->project_id);
            Gate::authorize('view', $project);
        }

        $expense->update($request->validated());
        return new ExpenseResource($expense);
    }

    public function destroy(string $id)
    {
        $expense = Expense::findOrFail($id);
        Gate::authorize('delete', $expense);
        
        $expense->delete();
        return response()->json(null, 204);
    }

    public function byProject($projectId)
    {
        $project = \App\Models\Project::findOrFail($projectId);
        Gate::authorize('view', $project);
        
        $expenses = Expense::with('project')->where('project_id', $projectId)->paginate(15);
        return ExpenseResource::collection($expenses);
    }
}
